<?php

namespace App\Console\Commands;

use App\Models\Log;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class StoreLogToDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:store-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will parse the log file and inserts the data into the logs table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = $this->ask('Please input the relative path of the log file or drag it into the command line');
        $file = trim($file , "'");
        
        if(!file_exists($file)){
            $this->error('File does not exist!');
        }else{
            $this->info('Starting import');
            
            File::lines($file)->each(function ($line) {
                list($service_name , $separator , $date_time , $method , $path , $protocol , $status_code) = preg_split("/\s/" , $line);
                try {
                    Log::create([
                        'service_name' => $service_name,
                        'date_time' => \Carbon\Carbon::createFromFormat('d/M/Y H:i:s', preg_replace("/\:/" , ' ' , trim($date_time , '[]') , 1) ), 
                        'method' => ltrim($method , '"'), 
                        'path' => $path, 
                        'protocol' => rtrim($protocol , '"'), 
                        'status_code' => (int) $status_code, 
                        'created_at' => now()
                    ]);
                } catch (\Exception $e) {
                    $this->error($e->getMessage());
                }
            });

            $this->info('Logs imported');
        }
    }
}
