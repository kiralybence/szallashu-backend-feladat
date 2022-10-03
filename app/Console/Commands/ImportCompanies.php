<?php

namespace App\Console\Commands;

use App\Imports\CompanyImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:companies {path : The CSV\'s filepath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import companies from a CSV';

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
        Excel::import(new CompanyImport(), $this->argument('path'));
        $this->info('Successfully imported companies.');

        return 0;
    }
}
