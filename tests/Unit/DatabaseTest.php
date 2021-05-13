<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class DatabaseTest extends TestCase
{

    /**
     * check master user is exist
     *
     * @return void
     */
    public function test_check_user_exist()
    {
        parent::setUp();
        $user = User::all()->find(1);
        $this->assertEquals('lord2350.mm@gmail.com',$user->email);
    }
}
