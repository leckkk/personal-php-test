<?php

namespace App\Console\Commands;

use App\Models\Screenshots;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Exception\RuntimeException;
use FFMpeg\FFMpeg;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ScreenshotsTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:screenshots {--url= : 指定的视频流}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试截取rtmp视频流图片';

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
        $url = $this->option('url');
        if ($url) {
            $urls = [
                'shopx' => [
                    'chn0' => $url . ' live=1'
                ]
            ];
        } else {
            $urls = [
                'shop1_chn2' => 'rtmp://relay021.yunding360.com:10102/live/B04B620407072_2_0?sn=B04B620407072&loginKey=PEFWnehHratKEyiq&chn=2 live=1',
                'shop1_chn0' => 'rtmp://relay021.yunding360.com:10102/live/B04B620407072_0_0?sn=B04B620407072&loginKey=VzFskSnJ9Sw4QECU&chn=0 live=1',
                'shop2_chn0' => 'rtmp://relay021.yunding360.com:10102/live/99C1A19C03344_0_0?sn=99C1A19C03344&loginKey=tbe3dzV66WUvsnfv&chn=0 live=1',
                'shop3_chn1' => 'rtmp://relay021.yunding360.com:10102/live/0407219805330_1_0?sn=0407219805330&loginKey=JWUcJRBujEW5duyW&chn=1 live=1',
                'shop3_chn0' => 'rtmp://relay021.yunding360.com:10102/live/0407219805330_0_0?sn=0407219805330&loginKey=uRfmRYdMVaKYIMKg&chn=0 live=1',
                'shop3_chn2' => 'rtmp://relay021.yunding360.com:10102/live/0407219805330_2_0?sn=0407219805330&loginKey=mQTDkZgnx2Z5XnlU&chn=2 live=1',
                'shop4_chn0' => 'rtmp://relay021.yunding360.com:10102/live/C8D6119805315_0_0?sn=C8D6119805315&loginKey=pLy52Z5mHd02UjjE&chn=0 live=1',
                'shop4_chn2' => 'rtmp://relay021.yunding360.com:10102/live/C8D6119805315_2_0?sn=C8D6119805315&loginKey=7XZMHUkmLDhTXP3x&chn=2 live=1',
                'shop4_chn1' => 'rtmp://relay021.yunding360.com:10102/live/C8D6119805315_1_0?sn=C8D6119805315&loginKey=pLy52Z5mHd02UjjE&chn=1 live=1',
                'shop4_chn3' => 'rtmp://relay021.yunding360.com:10102/live/C8D6119805315_3_0?sn=C8D6119805315&loginKey=pLy52Z5mHd02UjjE&chn=3 live=1',
                'shop5_chn0' => 'rtmp://relay021.yunding360.com:10102/live/A986E19B06264_0_0?sn=A986E19B06264&loginKey=aUXEkIWdbP1Fd7GN&chn=0 live=1',
                'shop6_chn1' => 'rtmp://relay021.yunding360.com:10102/live/99CE619C05048_1_0?sn=99CE619C05048&loginKey=0ygYyNv1Bsawmpnm&chn=1 live=1',
                'shop6_chn0' => 'rtmp://relay021.yunding360.com:10102/live/99CE619C05048_0_0?sn=99CE619C05048&loginKey=wkcJ2TloBbNKBH4g&chn=0 live=1',
                'shop7_chn0' => 'rtmp://relay021.yunding360.com:10102/live/EE8FF19C05021_0_0?sn=EE8FF19C05021&loginKey=x9jwsqZpzXCuiqAN&chn=0 live=1',
                'shop7_chn1' => 'rtmp://relay021.yunding360.com:10102/live/EE8FF19C05021_1_0?sn=EE8FF19C05021&loginKey=x9jwsqZpzXCuiqAN&chn=1 live=1',
                'shop8_chn0' => 'rtmp://relay021.yunding360.com:10102/live/2151219C05086_0_0?sn=2151219C05086&loginKey=UTHurUQI338gVj3R&chn=0 live=1',
                'shop8_chn3' => 'rtmp://relay021.yunding360.com:10102/live/2151219C05086_3_0?sn=2151219C05086&loginKey=UTHurUQI338gVj3R&chn=3 live=1',
                'shop8_chn1' => 'rtmp://relay021.yunding360.com:10102/live/2151219C05086_1_0?sn=2151219C05086&loginKey=UTHurUQI338gVj3R&chn=1 live=1',
                'shop8_chn2' => 'rtmp://relay021.yunding360.com:10102/live/2151219C05086_2_0?sn=2151219C05086&loginKey=UTHurUQI338gVj3R&chn=2 live=1',
                'shop8_chn4' => 'rtmp://relay021.yunding360.com:10102/live/2151219C05086_4_0?sn=2151219C05086&loginKey=UTHurUQI338gVj3R&chn=4 live=1',
                'shop8_chn5' => 'rtmp://relay021.yunding360.com:10102/live/2151219C05086_5_0?sn=2151219C05086&loginKey=UTHurUQI338gVj3R&chn=5 live=1',
                'shop9_chn0' => 'rtmp://relay021.yunding360.com:10102/live/E1B9A19C05042_0_0?sn=E1B9A19C05042&loginKey=AXin2NXyunGGWIf1&chn=0 live=1',
                'shop9_chn1' => 'rtmp://relay021.yunding360.com:10102/live/E1B9A19C05042_1_0?sn=E1B9A19C05042&loginKey=AXin2NXyunGGWIf1&chn=1 live=1',
                'shop9_chn2' => 'rtmp://relay021.yunding360.com:10102/live/E1B9A19C05042_2_0?sn=E1B9A19C05042&loginKey=1rWRvHsORyotKIfT&chn=2 live=1',
                'shop9_chn3' => 'rtmp://relay021.yunding360.com:10102/live/E1B9A19C05042_3_0?sn=E1B9A19C05042&loginKey=iEAFlVfWSwVPdIBZ&chn=3 live=1',
                'shop9_chn4' => 'rtmp://relay021.yunding360.com:10102/live/E1B9A19C05042_4_0?sn=E1B9A19C05042&loginKey=ZIfkggATTvFPN0po&chn=4 live=1',
                'shop9_chn5' => 'rtmp://relay021.yunding360.com:10102/live/E1B9A19C05042_5_0?sn=E1B9A19C05042&loginKey=ZIfkggATTvFPN0po&chn=5 live=1',
                'shop10_chn1' => 'rtmp://relay021.yunding360.com:10102/live/798EE19C03029_1_0?sn=798EE19C03029&loginKey=hZpn0p4Ny0F5Wiec&chn=1 live=1',
                'shop10_chn0' => 'rtmp://relay021.yunding360.com:10102/live/798EE19C03029_0_0?sn=798EE19C03029&loginKey=hZpn0p4Ny0F5Wiec&chn=0 live=1',
                'shop11_chn2' => 'rtmp://relay021.yunding360.com:10102/live/4327019C03822_2_0?sn=4327019C03822&loginKey=vwlzbwoawBPbL0Pg&chn=2 live=1',
                'shop11_chn0' => 'rtmp://relay021.yunding360.com:10102/live/4327019C03822_0_0?sn=4327019C03822&loginKey=vwlzbwoawBPbL0Pg&chn=0 live=1',
                'shop11_chn4' => 'rtmp://relay021.yunding360.com:10102/live/4327019C03822_4_0?sn=4327019C03822&loginKey=vwlzbwoawBPbL0Pg&chn=4 live=1',
                'shop11_chn3' => 'rtmp://relay021.yunding360.com:10102/live/4327019C03822_3_0?sn=4327019C03822&loginKey=vwlzbwoawBPbL0Pg&chn=3 live=1',
                'shop11_chn1' => 'rtmp://relay021.yunding360.com:10102/live/4327019C03822_1_0?sn=4327019C03822&loginKey=vwlzbwoawBPbL0Pg&chn=1 live=1',
                'shop12_chn0' => 'rtmp://relay021.yunding360.com:10102/live/D216219805324_0_0?sn=D216219805324&loginKey=D0bRbDjFNnCddCzZ&chn=0 live=1',
                'shop12_chn1' => 'rtmp://relay021.yunding360.com:10102/live/D216219805324_1_0?sn=D216219805324&loginKey=VlE89kP7Amo4uWz8&chn=1 live=1',
                'shop13_chn0' => 'rtmp://relay021.yunding360.com:10102/live/2C75F19C03044_0_0?sn=2C75F19C03044&loginKey=cVedoVdMQxIpsnED&chn=0 live=1',
                'shop13_chn1' => 'rtmp://relay021.yunding360.com:10102/live/2C75F19C03044_1_0?sn=2C75F19C03044&loginKey=cVedoVdMQxIpsnED&chn=1 live=1',
                'shop13_chn2' => 'rtmp://relay021.yunding360.com:10102/live/2C75F19C03044_2_0?sn=2C75F19C03044&loginKey=cVedoVdMQxIpsnED&chn=2 live=1',
                'shop13_chn3' => 'rtmp://relay021.yunding360.com:10102/live/2C75F19C03044_3_0?sn=2C75F19C03044&loginKey=cVedoVdMQxIpsnED&chn=3 live=1',
            ];
        }

        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
            'timeout' => 120, // The timeout for the underlying process
            'ffmpeg.threads' => 12,   // The number of threads that FFMpeg should use
        ]);

        foreach ($urls as $channel => $url) {
            try {
                $time = Redis::hget('screenshots', $channel);
                if (!$time) {
                    continue;
                }
                $video = $ffmpeg->open($url);
                $frame = $video->frame(TimeCode::fromSeconds(0));

                $fileName = 'video/' . $channel . '_' . now()->format('YmdHis') . '.jpg';
                if (!is_dir(storage_path("video"))) {
                    mkdir(storage_path("video"), 0755);
                }
                $frame->save(storage_path($fileName));
                Screenshots::create([
                    'url' => $fileName,
                    'screenshot_time' => $time,
                    'camera' => $channel
                ]);
                Redis::hdel('screenshots', $channel);
            } catch (RuntimeException $e) {
                Log::info('执行失败:' . $e->getMessage());
            }
        }
        Log::info('------------------------------------------------------');
    }
}
