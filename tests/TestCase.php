<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * 指定用户
     *
     * @param $id
     *
     * @return $this
     */
    public function user($id)
    {
        $user = User::findOrFail($id);
        $this->actingAs($user, 'api');

        return $this;
    }

    public function printResponse(TestResponse $response)
    {
        echo(json_encode(json_decode($response->getContent()), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
