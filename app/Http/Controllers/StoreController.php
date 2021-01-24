<?php

namespace App\Http\Controllers;

use Com\Alibaba\Otter\Canal\Protocol\EventType;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function store(array $data)
    {
        $query = DB::connection($data['database']);

        switch ($data['eventType']) {
            case EventType::EVENTTYPECOMPATIBLEPROTO2:
                break;
            case EventType::INSERT:
                $insert = [];
                foreach ($data['datas'] as $datas) {
                    foreach ($datas['after'] as $column) {
                        $insert[$column['name']] = $column['value'];
                    }
                }
                $query->table($data['table'])->insert($insert);
                break;
            case EventType::UPDATE:
                $update = [];
                foreach ($data['datas'] as $datas) {
                    foreach ($datas['after'] as $column) {
                        if ($column['is_update']) {
                            $update[$column['name']] = $column['value'];
                        }
                    }
                }
                $query->table($data['table'])->update($update);
                break;
            case EventType::DELETE:
                foreach ($data['datas'] as $datas) {
                    foreach ($datas['before'] as $column) {
                        if ($column['name'] = 'id') { //主键名一定要叫id
                            $query->table($data['table'])->delete($column['value']);
                        }
                    }
                }
                break;
            case EventType::CREATE:
            case EventType::ALTER:
            case EventType::ERASE: //drop table
                $query->statement($data['sql']);
                break;
            case EventType::QUERY:
                break;
            case EventType::TRUNCATE:
                break;
            case EventType::RENAME:
                break;
            case EventType::CINDEX:
                break;
            case EventType::DINDEX:
                break;
            case EventType::GTID:
                break;
            case EventType::XACOMMIT:
                break;
            case EventType::XAROLLBACK:
                break;
            case EventType::MHEARTBEAT:
                break;
            default:
                return 'error';
        }
    }
}
