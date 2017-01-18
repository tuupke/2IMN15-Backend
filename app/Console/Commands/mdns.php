<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Clue\React\Block;

class mdns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mdns:run';

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
     * @return mixed
     */
    public function handle()
    {

//        $outp = `gtimeout 3s dns-sd -L Broker-Room-1 _http._tcp. local`;
        $outp = "
        
         * Lookup Broker-Room-1._http._tcp..local
DATE: ---Tue 17 Jan 2017---
19:50:53.562  ...STARTING...
19:50:53.562  Broker-Room-1._http._tcp.local. can be reached at Equipo.local.:8080 (interface 5)
 “/broker
         ";

        $matches= [];
        $match = "None found";
        (preg_match("/can be reached .*? \\(/", $outp, $matches));
        if(count($matches)){

            $match = str_replace(['can be reached at ', '('], ['',''], $matches[0]);


            // Send local IP to /api/register/?host=<IP>
        }

        print_r($match);


    }
}
