<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Process\Process;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RestoreDatabaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file_path;

    /**
     * Create a new job instance.
     *
     * @param string $file_path
     */
    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        $file_path = $this->file_path;

        $db_host = env('DB_HOST', '127.0.0.1');
        $db_port = env('DB_PORT', '3306');
        $db_name = env('DB_DATABASE');
        $db_user = env('DB_USERNAME');
        $db_pass = env('DB_PASSWORD');

        if (!file_exists($file_path)) {
            Log::error("Backup file does not exist: {$file_path}");
            return;
        }

        if (!empty($password)) {
            $command = [
                'mysql',
                '-h', $db_host,
                '-P', $db_port,
                '-u', $db_user,
                '-p' . $db_pass,
                $db_name,
                '-e', "source {$file_path}",
            ];
        } else {
            $command = [
                'mysql',
                '-h', $db_host,
                '-P', $db_port,
                '-u', $db_user,
                $db_name,
                '-e', "source {$file_path}",
            ];
        }

        $process = new Process($command);
        $process->setTimeout(null);

        $process->run(function ($type, $buffer) {
            if ($type === Process::ERR) {
                Log::error($buffer);
            } else {
                Log::info($buffer);
            }
        });

        if ($process->isSuccessful()) {
            return true;
        } else {
            return false;
        }
    }
}
