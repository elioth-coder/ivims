<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoFillController extends Controller
{
    public function policy_holder(Request $request, $id_number)
    {
        try {
            $sql =
            "SELECT * FROM `policy_holders`
            WHERE `id_number`=:id_number
            ORDER BY created_at DESC
            LIMIT 1
            ";
            $pdo = DB::connection()->getPdo();
            $query = $pdo->prepare($sql);
            $query->execute([
                'id_number' => $id_number,
            ]);

            $policy_holder = $query->fetchObject('stdClass');

            if($policy_holder) {
                return response()->json([
                    'status' => 'success',
                    'policy_holder' => $policy_holder,
                ], 200);
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'No data found',
                ], 500);
            }
        } catch(Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function vehicle_detail(Request $request, $plate_no)
    {
        try {
            $sql =
            "SELECT * FROM `vehicle_details`
            WHERE `plate_no`=:plate_no
            ORDER BY created_at DESC
            LIMIT 1
            ";
            $pdo = DB::connection()->getPdo();
            $query = $pdo->prepare($sql);
            $query->execute([
                'plate_no' => $plate_no,
            ]);

            $vehicle_detail = $query->fetchObject('stdClass');

            if($vehicle_detail) {
                return response()->json([
                    'status' => 'success',
                    'vehicle_detail' => $vehicle_detail,
                ], 200);
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'No data found',
                ], 500);
            }
        } catch(Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
