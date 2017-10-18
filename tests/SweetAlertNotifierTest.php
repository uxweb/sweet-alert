<?php

use Mockery as m;
use UxWeb\SweetAlert\SessionStore;
use UxWeb\SweetAlert\SweetAlertNotifier;

class SweetAlertNotifierTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_flashes_config_for_a_basic_alert()
    {
        $session = m::spy(SessionStore::class);
        $notifier = new SweetAlertNotifier($session);

        $notifier->basic('Basic Alert!', 'Alert');

        $expectedConfig = [
            'timer'             => 1800,
            'title'             => 'Alert',
            'text'              => 'Basic Alert!',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldHaveReceived('flash')->with('sweet_alert.timer', $expectedConfig['timer'])->once();
        $session->shouldHaveReceived('flash')->with('sweet_alert.title', $expectedConfig['title'])->once();
        $session->shouldHaveReceived('flash')->with('sweet_alert.text', $expectedConfig['text'])->once();
        $session->shouldHaveReceived('flash')->with('sweet_alert.alert', $expectedJsonConfig)->once();
        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_flashes_config_for_a_info_alert()
    {
        $session = m::mock(SessionStore::class);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'timer'             => 1800,
            'title'             => 'Alert',
            'text'              => 'Info Alert!',
            'icon'              => 'info',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.icon', $expectedConfig['icon']);
        $session->shouldReceive('flash')->with('sweet_alert.alert', $expectedJsonConfig);

        $notifier->info('Info Alert!', 'Alert');

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_flashes_config_for_a_success_alert()
    {
        $session = m::mock(SessionStore::class);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'timer'             => 1800,
            'title'             => 'Success!',
            'text'              => 'Well Done!',
            'icon'              => 'success',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.icon', $expectedConfig['icon']);
        $session->shouldReceive('flash')->with('sweet_alert.alert', $expectedJsonConfig);

        $notifier->success('Well Done!', 'Success!');

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_flashes_config_for_a_warning_alert()
    {
        $session = m::mock(SessionStore::class);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'timer'             => 1800,
            'title'             => 'Watch Out!',
            'text'              => 'Hey cowboy!',
            'icon'              => 'warning',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.icon', $expectedConfig['icon']);
        $session->shouldReceive('flash')->with('sweet_alert.alert', $expectedJsonConfig);

        $notifier->warning('Hey cowboy!', 'Watch Out!');

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_flashes_config_for_a_error_alert()
    {
        $session = m::mock(SessionStore::class);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'timer'             => 1800,
            'title'             => 'Whoops!',
            'text'              => 'Something wrong happened!',
            'icon'              => 'error',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.icon', $expectedConfig['icon']);
        $session->shouldReceive('flash')->with('sweet_alert.alert', $expectedJsonConfig);

        $notifier->error('Something wrong happened!', 'Whoops!');

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_flashes_timer_config_using_an_autoclose_alert()
    {
        $session = m::mock(SessionStore::class);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'timer'             => 2000,
            'title'             => 'Alert',
            'text'              => 'Hello!',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', 1800);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.alert', json_encode(array_merge($expectedConfig, ['timer' => 1800])));
        $session->shouldReceive('flash')->with('sweet_alert.alert', $expectedJsonConfig);

        $notifier->message('Hello!', 'Alert')->autoclose(2000);

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_flashes_the_message_as_the_alert_title_if_no_title_is_passed_for_json_config()
    {
        $session = m::mock(SessionStore::class);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'timer'             => 1800,
            'title'             => '',
            'text'              => 'This should be the title!',
        ];
        $expectedJsonConfig = json_encode([
            'timer'             => 1800,
            'title'             => 'This should be the title!',
        ]);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.alert', $expectedJsonConfig);

        $notifier->message('This should be the title!');

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_removes_the_timer_option_from_config_when_using_a_persistent_alert()
    {
        $session = m::mock(SessionStore::class);
        $session->shouldReceive('flash')->atLeast(1);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'title'               => 'Alert',
            'text'                => 'Please, read with care!',
            'button'              => 'Got it!',
            'closeOnClickOutside' => true,
        ];
        $expectedJsonConfig = json_encode($expectedConfig);

        $notifier->message('Please, read with care!', 'Alert')->persistent('Got it!');

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_removes_the_timer_option_from_config_when_using_a_persistent_alert_with_custom_buttons()
    {
        $session = m::mock(SessionStore::class);
        $session->shouldReceive('flash')->atLeast(1);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'title'               => 'Alert',
            'text'                => 'Please, read with care!',
            'buttons'             => ['No', 'Yes'],
            'closeOnClickOutside' => true,
        ];
        $expectedJsonConfig = json_encode($expectedConfig);

        $notifier->message('Please, read with care!', 'Alert')->persistent(['No', 'Yes']);

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_show_a_confirm_button_with_custom_text()
    {
        $session = m::mock(SessionStore::class);
        $session->shouldReceive('flash')->atLeast(1);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'timer'              => 1800,
            'title'              => 'Alert',
            'text'               => 'Basic Alert!',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);

        $notifier->basic('Basic Alert!', 'Alert');

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_show_a_cancel_button_with_custom_text()
    {
        $session = m::spy(SessionStore::class);
        $notifier = new SweetAlertNotifier($session);

        $notifier->basic('Basic Alert!', 'Alert');

        $expectedConfig = [
            'timer'              => 1800,
            'title'              => 'Alert',
            'text'               => 'Basic Alert!',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldHaveReceived('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    public function tearDown()
    {
        m::close();
    }
}

function config($key, $default)
{
    return 1800;
}
