<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * After the first run of setUp "migrate:fresh --seed"
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Artisan::call(
            'db:seed', ['--class' => 'DatabaseSeeder']
        );
    }
}

