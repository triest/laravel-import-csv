<?php

namespace App\Console\Commands;

use App\Imports\CustomersImport;
use Illuminate\Console\Command;

class CustomersImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import customers from csv';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
             $import = new CustomersImport();
             $import->import('РНР_random.csv');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
            return 0;
        }
    }
}
