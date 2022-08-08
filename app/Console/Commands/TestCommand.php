<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $data["email"] = "shivendrasinhj.ap@gmail.com";
        $data["title"] = "Bulk Leads Manager";
        $data["body"] = "Bulk Leads Manager";

        Mail::send('leadDeleteMail', $data, function($message)use($data) {
            $message->to($data["email"], $data["email"])->subject($data["title"]);
        });

        echo "Mail Send Successfully.";
    }
}
