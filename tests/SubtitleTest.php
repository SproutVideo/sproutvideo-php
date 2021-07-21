<?php 
use \Mockery\Adapter\Phpunit\MockeryTestCase;

final class SubtitleTest extends MockeryTestCase
{
    public function testItCanRequestAllSubtitles()
    {

        $spy = Mockery::mock('alias:SproutVideo\Resource')->shouldAllowMockingProtectedMethods();
        $sut = new SproutVideo\Subtitle($spy);
        $spy->shouldReceive('get')->once()->with('videos/1234/subtitles', ['video_id' => '1234']);  

        $sut->list_subtitles(array('video_id' => '1234'));

        // $spy->shouldHaveReceived()->get()->with('/subtitles', 'tok_valid-token');  
        // Mockery::close();

        // // Create a mock for the Observer class,
        // // only mock the update() method.
        // $observer = $this->createMock(SproutVideo\CurlClient::class);

        // // Set up the expectation for the update() method
        // // to be called only once and with the string 'something'
        // // as its parameter.
        // $observer->expects($this->once())
        //          ->method('get');
        //         //  ->with($this->equalTo('something'));

        // // Create a Subject object and attach the mocked
        // // Observer object to it.
        // $subject = new SproutVideo\Subtitle;
        // $subject->observers[] = $observer;
        // // $subject->attach($observer);

        // // Call the doSomething() method on the $subject object
        // // which we expect to call the mocked Observer object's
        // // update() method with the string 'something'.
        // $subject->list_subtitles(array('video_id' => '1234'));
    }
}