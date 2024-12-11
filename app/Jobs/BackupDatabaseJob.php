<?php

namespace App\Jobs;

use Exception;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class BackupDatabaseJob implements ShouldQueue
{
    use Queueable;
    /**
     * Execute the job.
     */
    public function handle()
    {
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        $backup_folder = 'app' . DIRECTORY_SEPARATOR . 'private' . DIRECTORY_SEPARATOR . 'backups';
        $file_name = 'BACKUP_' . now()->format('Y_m_d_His') . '.sql';
        $file_path = storage_path($backup_folder . DIRECTORY_SEPARATOR . $file_name);

        if (!Storage::exists($backup_folder)) {
            Storage::makeDirectory($backup_folder);
        }

        if (!empty($password)) {
            $command = "mysqldump --single-transaction --routines --triggers -u{$username} -p{$password} -h{$host} {$database} > \"{$file_path}\"";
        } else {
            $command = "mysqldump --single-transaction --routines --triggers -u{$username} -h{$host} {$database} > \"{$file_path}\"";
        }

        $process = Process::fromShellCommandline($command);
        $process->run();

        if ($process->isSuccessful()) {
            $message = "Backup created successfully: {$file_path}";
            return $file_path;
        } else {
            $message = "Backup failed: " . $process->getErrorOutput();
            throw new Exception($message);
        }
    }
}
