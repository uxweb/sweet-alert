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
            'showConfirmButton' => false,
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldHaveReceived('flash')->with('sweet_alert.timer', $expectedConfig['timer'])->once();
        $session->shouldHaveReceived('flash')->with('sweet_alert.title', $expectedConfig['title'])->once();
        $session->shouldHaveReceived('flash')->with('sweet_alert.text', $expectedConfig['text'])->once();
        $session->shouldHaveReceived('flash')->with('sweet_alert.showConfirmButton', $expectedConfig['showConfirmButton'])->once();
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
            'showConfirmButton' => false,
            'type'              => 'info',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.showConfirmButton', $expectedConfig['showConfirmButton']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.type', $expectedConfig['type']);
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
            'showConfirmButton' => false,
            'type'              => 'success',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.showConfirmButton', $expectedConfig['showConfirmButton']);
        $session->shouldReceive('flash')->with('sweet_alert.type', $expectedConfig['type']);
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
            'showConfirmButton' => false,
            'type'              => 'warning',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.showConfirmButton', $expectedConfig['showConfirmButton']);
        $session->shouldReceive('flash')->with('sweet_alert.type', $expectedConfig['type']);
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
            'showConfirmButton' => false,
            'type'              => 'error',
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.showConfirmButton', $expectedConfig['showConfirmButton']);
        $session->shouldReceive('flash')->with('sweet_alert.type', $expectedConfig['type']);
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
            'showConfirmButton' => false,
        ];
        $expectedJsonConfig = json_encode($expectedConfig);
        $session->shouldReceive('flash')->with('sweet_alert.timer', 1800);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.showConfirmButton', $expectedConfig['showConfirmButton']);
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
            'showConfirmButton' => false,
        ];
        $expectedJsonConfig = json_encode([
            'timer'             => 1800,
            'title'             => 'This should be the title!',
            'showConfirmButton' => false,
        ]);
        $session->shouldReceive('flash')->with('sweet_alert.timer', $expectedConfig['timer']);
        $session->shouldReceive('flash')->with('sweet_alert.text', $expectedConfig['text']);
        $session->shouldReceive('flash')->with('sweet_alert.title', $expectedConfig['title']);
        $session->shouldReceive('flash')->with('sweet_alert.showConfirmButton', $expectedConfig['showConfirmButton']);
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
            'title'             => 'Alert',
            'text'              => 'Please, read with care!',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Got it!',
            'allowOutsideClick' => false,
        ];
        $expectedJsonConfig = json_encode($expectedConfig);

        $notifier->message('Please, read with care!', 'Alert')->persistent('Got it!');

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_will_add_the_html_option_to_config_when_using_an_html_alert()
    {
        $session = m::mock(SessionStore::class);
        $session->shouldReceive('flash')->atLeast(1);
        $notifier = new SweetAlertNotifier($session);
        $expectedConfig = [
            'timer'             => 1800,
            'title'             => 'Alert',
            'text'              => '<strong>This should be bold!</strong>',
            'showConfirmButton' => false,
            'html'              => true,
        ];
        $expectedJsonConfig = json_encode($expectedConfig);

        $notifier->message('<strong>This should be bold!</strong>', 'Alert')->html();

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
            'title'              => 'Alert',
            'text'               => 'Basic Alert!',
            'showConfirmButton'  => true,
            'confirmButtonText'  => 'ok!',
            'allowOutsideClick'  => false,
        ];
        $expectedJsonConfig = json_encode($expectedConfig);

        $notifier->basic('Basic Alert!', 'Alert')->confirmButton('ok!');

        $this->assertEquals($expectedConfig, $notifier->getConfig());
        $this->assertEquals($expectedJsonConfig, $notifier->getJsonConfig());
    }

    /** @test */
    public function it_show_a_cancel_button_with_custom_text()
    {
        $session = m::spy(SessionStore::class);
        $notifier = new SweetAlertNotifier($session);

        $notifier->basic('Basic Alert!', 'Alert')->cancelButton('Cancel!');

        $expectedConfig = [
            'title'             => 'Alert',
            'text'              => 'Basic Alert!',
            'showConfirmButton' => false,
            'showCancelButton'  => true,
            'cancelButtonText'  => 'Cancel!',
            'allowOutsideClick' => false,
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
