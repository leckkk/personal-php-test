<?php

namespace App\Console\Commands;

use Api\Brand\V1\BrandClient;
use Api\Brand\V1\ListBrandRequest;
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

        $client = new BrandClient($hostname, [
            'credentials' => \Grpc\ChannelCredentials::createInsecure(),
        ]);

        $request = new ListBrandRequest();
        list($response, $status) = $client->ListBrand($request)->wait();

        if ($status->code !== \Grpc\STATUS_OK) {
            echo "ERROR: " . $status->code . ", " . $status->details . PHP_EOL;
            exit(1);
        }

        $brands = [];
        foreach ($response->getBrands() as $brand) {
            $brands[] = [
                'id' => $brand->getId(),
                'name' => $brand->getName(),
            ];
        }

        dump($brands);

//        echo $response->getMessage() . PHP_EOL;
    }
}
