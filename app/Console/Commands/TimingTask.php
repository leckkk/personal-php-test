<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class TimingTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timing_task:screenshots';

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
        $failitem = Redis::hgetall('screenshots');
        if ($failitem) {
            Log::channel('single')->error('执行失败记录：', $failitem);
            Redis::hdel('screenshots', ...array_keys($failitem));
        }


        $urls = [
        ];
        foreach ($urls as $channel => $url) {
            Redis::hset('screenshots', $channel, now()->format('YmdHis'));
        }
    }
}
