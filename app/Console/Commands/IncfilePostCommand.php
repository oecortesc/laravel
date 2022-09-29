<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use guzzlehttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7;

class IncfilePostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'incfile:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Incfile POST https://atomic.incfile.com/fakepost';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        try {
            $client = new Client();
            $request = new Request('POST','https://atomic.incfile.com/fakepost');
            $promise = $client->sendAsync($request)->then(function ($response) {
                echo $response->getBody();
            });
            $promise->wait();
            echo Command::SUCCESS;
        }  catch (RequestException $e) {
            echo Psr7\Message::toString($e->getResponse());
        }
    }
}
