<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\OrdersController;

class LeadSend extends Command
{
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

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
   public function handle()
    {
        OrdersController::sendLead();
       
    }
}
