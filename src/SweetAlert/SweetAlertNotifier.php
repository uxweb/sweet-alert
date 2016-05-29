<?php

namespace UxWeb\SweetAlert;

class SweetAlertNotifier
{
    /**
     * @var \UxWeb\SweetAlert\SessionStore
     */
    private $session;

    /**
     * Configuration options.
     *
     * @var array
     */
    private $config = [
        'showConfirmButton' => false,
        'timer'             => 1800,
        'allowOutsideClick' => true,
    ];

    /**
     * Create a new SweetAlertNotifier instance.
     *
     * @param \UxWeb\SweetAlert\SessionStore $session
     */
    public function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Display an alert message with a text and an optional title.
     *
     * By default the alert is not typed.
     *
     * @param string $text
     * @param string $type
     * @param string $title
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function message($text, $title = '', $type = null)
    {
        $this->config['text'] = $text;
        $this->config['title'] = $title;
        $this->config['type'] = $type;
        $this->flashConfig();

        return $this;
    }

    /**
     * Display a not typed alert message with a text and a title.
     *
     * @param string $text
     * @param string $title
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function basic($text, $title)
    {
        $this->message($text, $title);

        return $this;
    }

    /**
     * Display an info typed alert message with a text and an optional title.
     *
     * @param string $text
     * @param string $title
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function info($text, $title = '')
    {
        $this->message($text, $title, 'info');

        return $this;
    }

    /**
     * Display a success typed alert message with a text and an optional title.
     *
     * @param string $text
     * @param string $title
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function success($text, $title = '')
    {
        $this->message($text, $title, 'success');

        return $this;
    }

    /**
     * Display an error typed alert message with a text and an optional title.
     *
     * @param string $text
     * @param string $title
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function error($text, $title = '')
    {
        $this->message($text, $title, 'error');

        return $this;
    }

    /**
     * Display a warning typed alert message with a text and an optional title.
     *
     * @param string $text
     * @param string $title
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function warning($text, $title = '')
    {
        $this->message($text, $title, 'warning');

        return $this;
    }

    /**
     * Set the duration for this alert until it autocloses.
     *
     * @param int $milliseconds
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function autoclose($milliseconds = 1800)
    {
        $this->config['timer'] = $milliseconds;
        $this->flashConfig();

        return $this;
    }

    /**
     * Add a confirmation button to the alert.
     *
     * @param string $buttonText
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function confirmButton($buttonText = 'OK')
    {
        $this->config['confirmButtonText'] = $buttonText;
        $this->config['showConfirmButton'] = true;
        $this->flashConfig();

        return $this;
    }

    /**
     * Make this alert persistent with a confirmation button.
     *
     * @param string $buttonText
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function persistent($buttonText = 'OK')
    {
        $this->config['confirmButtonText'] = $buttonText;
        $this->config['showConfirmButton'] = true;
        $this->config['allowOutsideClick'] = false;
        $this->config['timer'] = 'null';
        $this->flashConfig();

        return $this;
    }

    /**
     * Flash the configuration.
     *
     * return void
     */
    private function flashConfig()
    {
        foreach ($this->config as $key => $value) {
            $this->session->flash("sweet_alert.{$key}", $value);
        }

        $this->session->flash('sweet_alert.alert', $this->buildConfig());
    }

    /**
     * Build the configuration.
     *
     * @return string
     */
    private function buildConfig()
    {
        if (!$this->hasTitle()) {
            $this->switchTitle();
        }

        return json_encode($this->config);
    }

    /**
     * Switch the text message to the title key.
     *
     * @return string
     */
    private function switchTitle()
    {
        $this->config['title'] = $this->config['text'];
        unset($this->config['text']);
    }

    /**
     * Determine if the title is set.
     *
     * @return bool
     */
    private function hasTitle()
    {
        return (bool) strlen($this->config['title']);
    }
    
    /**
     * Make Message HTML view.
     *
     * @param bool|true $html
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function html()
    {
        $this->config['html'] = true;

        $this->flashConfig();

        return $this;
    }
}
