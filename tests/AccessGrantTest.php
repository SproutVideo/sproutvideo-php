<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class AccessGrantTest extends MockeryTestCase
{
    private static $resource;

    public function setup(): void
    {
        self::$resource = Mockery::spy('alias:SproutVideo\Resource');
    }

    public function testItGetsAll()
    {
        $options = ['per_page' => 10];
        SproutVideo\AccessGrant::list_access_grants($options);

        self::$resource->shouldHaveReceived('get')->once()->with('access_grants', $options);  
    }

    public function testItCanGetDetails()
    {
        SproutVideo\AccessGrant::get_access_grant('abcds1');

        self::$resource->shouldHaveReceived('get')->once()->with('access_grants/abcds1', null);  
    }

    public function testItCanCreate()
    {
        $data = [
            'video_id' => 'abc123',
            'login_id' => 'abc123'
        ];

        SproutVideo\AccessGrant::create_access_grant($data);

        self::$resource->shouldHaveReceived('post')->once()->with('access_grants', $data, null);  
    }

    public function testItCanCreateInBulk()
    {
        $data = [
            'video_id' => 'abc123',
            'login_id' => 'abc123'
        ];

        $bulk_data = [$data, $data];
        SproutVideo\AccessGrant::bulk_create_access_grants($bulk_data);

        self::$resource->shouldHaveReceived('post')->once()->with('access_grants/bulk', $bulk_data, null);  
    }

    public function testItCanUpdate()
    {
        $data = ['video_id' => '123abc'];
        $id = 'fe23';
        SproutVideo\AccessGrant::update_access_grant($id, $data);

        self::$resource->shouldHaveReceived('put')->once()->with('access_grants/'.$id, $data, null);  
    }

    public function testItCanDelete()
    {
        $id = 'fe23';
        SproutVideo\AccessGrant::delete_access_grant($id);

        self::$resource->shouldHaveReceived('delete')->once()->with('access_grants/'.$id, null);  
    }
}