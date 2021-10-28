<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class LoginTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItGetsAll()
    {
        SproutVideo\Login::list_logins();

        self::$resource->shouldHaveReceived('get')->once()->with('logins', null);  
    }

    public function testItCanGetDetails()
    {
        SproutVideo\Login::get_login('213asf');

        self::$resource->shouldHaveReceived('get')->once()->with('logins/213asf', null);  
    }

    public function testItCanCreate()
    {
        $data = [ 'emai' => 'test@example.com', 'password' => 'psswrd' ];
        SproutVideo\Login::create_login($data);

        self::$resource->shouldHaveReceived('post')->once()->with('logins', $data, null);  
    }

    public function testItCanUpdate()
    {
        $data = [ 'password' => 'newpassword' ];
        SproutVideo\Login::update_login('1212', $data);

        self::$resource->shouldHaveReceived('put')->once()->with('logins/1212', $data, null);  
    }

    public function testItCanDelete()
    {
        SproutVideo\Login::delete_login('1212');

        self::$resource->shouldHaveReceived('delete')->once()->with('logins/1212', null);  
    }
}