<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PusherSampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pusher_sample';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'pusher_sample';

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
     * @return mixed
     */
    public function handle()
    {
        //

        // require 'C:\Users\yu\Desktop\sample_code\lara-pusher-sample\vendor\autoload.php';

        // // $pusher = new Pusher\Pusher("APP_KEY", "APP_SECRET", "APP_ID", array('cluster' => 'APP_CLUSTER'));
        // // $pusher->trigger('my-channel', 'my-event', array('message' => 'hello world'));
        
        // $pusher = new Pusher\Pusher("7b5150d331d136146d67", "c9cb8943619845c2f930", "1045036", array('cluster' => 'ap3'));
        // $pusher->trigger('my-channel', 'my-event', array('message' => 'hello world'));
    }
}
