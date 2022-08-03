<?php

namespace App\Console\Commands;

use App\Http\Controllers\LeadDeleteController;
use Illuminate\Console\Command;

class LeadDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lead:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lead Delete';

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
        LeadDeleteController::LeadDelete();
    }
}
