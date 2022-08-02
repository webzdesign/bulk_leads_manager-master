<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use Illuminated\Console\WithoutOverlapping;
use App\Http\Controllers\OrdersController;

class LeadSend extends Command
{
    // use WithoutOverlapping;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lead:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending lead data into client';

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
        OrdersController::sendLead();
    }
}
