<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class AccountTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItCanGetDetails()
    {
        SproutVideo\Account::get_account();

        self::$resource->shouldHaveReceived('get')->once()->with('account', null);  
    }

    public function testItCanUpdate()
    {
        $data = ['download_sd' => true];
        SproutVideo\Account::update_account($data);

        self::$resource->shouldHaveReceived('put')->once()->with('account', $data, null);  
    }
}