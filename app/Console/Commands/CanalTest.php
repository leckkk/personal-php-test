<?php

namespace App\Console\Commands;

use Com\Alibaba\Otter\Canal\Protocol\Entry;
use Com\Alibaba\Otter\Canal\Protocol\EntryType;
use Com\Alibaba\Otter\Canal\Protocol\EventType;
use Com\Alibaba\Otter\Canal\Protocol\RowChange;
use Com\Alibaba\Otter\Canal\Protocol\RowData;
use Google\Protobuf\Internal\RepeatedField;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use xingwenge\canal_php\CanalClient;
use xingwenge\canal_php\CanalConnectorFactory;
use xingwenge\canal_php\Fmt;

class CanalTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'canal:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试canal';

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
        try {
            $client = CanalConnectorFactory::createClient(CanalClient::TYPE_SOCKET_CLUE);
            # $client = CanalConnectorFactory::createClient(CanalClient::TYPE_SWOOLE);

            //canal-server 监听地址端口
            $client->connect("104.168.43.142", 11111);
            $client->checkValid();
            //订阅binlog信息 与canal-server配置一致
            $client->subscribe("1001", "example", "canal_test\\..*");
            # $client->subscribe("1001", "example", "db_name.tb_name"); # 设置过滤

            while (true) {
                $message = $client->get(100);
                if ($entries = $message->getEntries()) {
                    foreach ($entries as $entry) {
                        Fmt::println($entry);
                        $res = $this->entryParser($entry);
                        Log::info('res:', $this->entryParser($entry));
                        dump($res);
                    }
                }
                sleep(1);
            }

            $client->disConnect();
        } catch (\Exception $e) {
            echo $e->getMessage(), PHP_EOL;
        }
    }

    public function entryParser(Entry $entry)
    {
        $entryType = $entry->getEntryType();
        if (in_array($entryType, [EntryType::TRANSACTIONBEGIN, EntryType::TRANSACTIONEND])) {
            return [];
        }

        $rowChange = new RowChange();
        $rowChange->mergeFromString($entry->getStoreValue());
        $evenType = $rowChange->getEventType();
        $header = $entry->getHeader();

        $rowDatas = $rowChange->getRowDatas();
        $response = [];

        foreach ($rowDatas as $rowData) {
            $res = [];
            $res['database'] = $header->getSchemaName();
            $res['table'] = $header->getTableName();
            $res['eventType'] = EventType::name($evenType);
            $res['sql'] = $rowChange->getSql();
            $res['before'] = $this->rowDataParse($rowData->getBeforeColumns());
            $res['after'] = $this->rowDataParse($rowData->getAfterColumns());
            $response[] = $res;
        }

        return $response;
    }

    public function rowDataParse(RepeatedField $columns)
    {
        $response = [];
        foreach ($columns as $column) {
            $col = [];
            $col['name'] = $column->getName();
            $col['value'] = $column->getValue();
            $col['is_update'] = $column->getUpdated();
            $response[] = $col;
        }
        return $response;
    }
}
