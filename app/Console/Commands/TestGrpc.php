<?php

namespace App\Console\Commands;

use app\Grpc\UserServiceClient;
use Illuminate\Console\Command;

class TestGrpc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grpc:test';

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
        $this->hello();
    }

    private function hello()
    {
        // 服务端ip地址:端口
        $hostname = '0.0.0.0:9001';

        $client = new UserServiceClient($hostname, [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(),
        ]);

        $request = new \GetUserRequest();
        $request->setId(2);
        list($response, $status) = $client->GetUser($request)->wait();

        if ($status->code !== \Grpc\STATUS_OK) {
            echo "ERROR: " . $status->code . ", " . $status->details . PHP_EOL;
            exit(1);
        }

        dump($response->getUser()->getName());

//        echo $response->getMessage() . PHP_EOL;
    }
}
