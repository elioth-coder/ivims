<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PolicyDetail;
use App\Models\PolicyHolder;
use App\Models\VehicleDetail;
use App\Jobs\BackupDatabaseJob;
use App\Jobs\RestoreDatabaseJob;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ToolController extends Controller
{
    public function update_municipality(Request $request)
    {
        try {
            $data = $request->all();
            $policy_holder = PolicyHolder::findOrFail($data['id']);
            $policy_holder->update([
                'province'     => $data['province'],
                'municipality' => $data['municipality'],
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Data updated successfully!',
                'policy_holder' => $policy_holder,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
                'status'  => 'error',
            ], 200);
        }
    }

    public function process_import(Request $request, $target)
    {
        try {
            $data = $request->all();

            if($target == 'companies') {
                Company::create($data);
            }
            if($target == 'vehicle_details') {
                VehicleDetail::create($data);
            }
            if($target == 'policy_holders') {
                $data['birthday'] = Carbon::parse($data['birthday']);
                PolicyHolder::create($data);
            }
            if($target == 'policy_details') {
                $data['coc_no']    = substr((floor(microtime(true) * 1000) . ''), 0, 13) . mt_rand(100,999);;
                $data['policy_no'] = substr((floor(microtime(true) * 1000) . ''), 0, 13) . mt_rand(100,999);;
                $data['or_no']     = substr((floor(microtime(true) * 1000) . ''), 0, 13) . mt_rand(100,999);;
                $data['date_issued']    = Carbon::parse($data['date_issued']);
                $data['inception_date'] = Carbon::parse($data['inception_date']);
                $data['expiry_date']    = Carbon::parse($data['expiry_date']);

                PolicyDetail::create($data);
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Data inserted successfully!',
                'data'    => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
                'status'  => 'error',
            ], 200);
        }
    }

    public function data_import()
    {
        return view('tools.data_import');
    }

    public function data_faker()
    {
        return view('tools.data_faker');
    }

    public function raw_data(Request $request)
    {
        if($request->input('data_target') == 'companies') {
            $items =
            Company::paginate($request->input('data_limit'))
                ->withQueryString();;
        }
        if($request->input('data_target') == 'vehicle_details') {
            $items =
            VehicleDetail::paginate($request->input('data_limit'))
                ->withQueryString();;
        }
        if($request->input('data_target') == 'policy_holders') {
            $items =
            PolicyHolder::paginate($request->input('data_limit'))
                ->withQueryString();;
        }
        if($request->input('data_target') == 'policy_details') {
            $items =
            PolicyDetail::paginate($request->input('data_limit'))
                ->withQueryString();;
        }

        return view('tools.raw_data', [
            'items' => $items ?? [],
        ]);
    }

    public function backup_restore()
    {
        $backup_folder = 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'backups';
        $file_path = storage_path($backup_folder);
        $files = File::allFiles($file_path);

        $files = collect($files)
            ->map(function($file) {
                return [
                    'name' => $file->getFilename(),
                    'size' => $file->getSize(),
                    'modified' => date('Y-m-d H:i:s', $file->getMTime()),
                ];
            })
            ->sortByDesc('modified');

        return view('tools.backup_restore', compact('files'));
    }

    public function generate()
    {
        try {
            BackupDatabaseJob::dispatch();
            sleep(5);
            return response()->json([
                'status'  => 'success',
                'message' => "Successfully created the backup file",
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function restore_from_file(Request $request)
    {
        try {
            $backup_file = $request->file('file');

            $backup_folder = 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'backups';
            $backup_folder = storage_path($backup_folder);
            $restore_file_name = 'RESTORE_' . now()->format('Y_m_d_His') . '.sql';
            $backup_file->move($backup_folder, $restore_file_name);
            $file_path = $backup_folder . DIRECTORY_SEPARATOR . $restore_file_name;

            RestoreDatabaseJob::dispatch($file_path);
            sleep(5);
            return response()->json([
                'status'  => 'success',
                'message' => "Successfully restored the database",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to restore the database.'
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $backup_folder = 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'backups';
        $backup_folder = storage_path($backup_folder);
        $file_name = $request->input('file_name');
        $file_path = $backup_folder . DIRECTORY_SEPARATOR . $file_name;

        if (File::exists($file_path)) {
            File::delete($file_path);

            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully deleted the backup file',
                'path'    => $file_path,
            ], 200);
        } else {

            return response()->json([
                'status'  => 'error',
                'message' => 'File not found',
            ], 500);
        }
    }

    public function restore(Request $request)
    {
        try {
            $file_name = $request->input('file_name');
            $backup_folder = 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'backups';
            $file_path = storage_path($backup_folder . DIRECTORY_SEPARATOR . $file_name);

            RestoreDatabaseJob::dispatch($file_path);
            sleep(5);
            return response()->json([
                'status'  => 'success',
                'message' => "Successfully restored the database",
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function download(Request $request, $file_name)
    {
        $backup_folder = 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'backups';
        $file_path = storage_path($backup_folder . DIRECTORY_SEPARATOR . $file_name);

        if (!File::exists($file_path)) {
            return response()->json([
                'message' => 'File not found.'
            ], 404);
        }

        return response()->download($file_path);
    }

}
