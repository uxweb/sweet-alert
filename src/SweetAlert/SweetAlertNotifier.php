<?php

namespace UxWeb\SweetAlert;

class SweetAlertNotifier
{
    /**
     * @var \UxWeb\SweetAlert\SessionStore
     */
    protected $session;

    /**
     * Configuration options.
     *
     * @var array
     */
    protected $config;

    /**
     * Create a new SweetAlertNotifier instance.
     *
     * @param \UxWeb\SweetAlert\SessionStore $session
     */
    public function __construct(SessionStore $session)
    {
        $this->setDefaultConfig();

        $this->session = $session;
    }

    /**
     * Sets all default config options for an alert.
     *
     * @return void
     */
    protected function setDefaultConfig()
    {
        $this->config = [
            'timer'             => config('sweet-alert.autoclose', 1800),
            'title'             => '',
            'text'              => '',
        ];
    }

    /**
     * Display an alert message with a text and an optional title.
     *
     * By default the alert is not typed.
     *
     * @param string $text
     * @param string $icon
     * @param string $title
     *
     * @return \UxWeb\SweetAlert\SweetAlertNotifier $this
     */
    public function message($text, $title = '', $icon = null)
    {
        $this->config['text'] = $text;
        $this->config['title'] = $title;

        if (!is_null($icon)) {
            $this->config['icon'] = $icon;
        }

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
    public function autoclose($milliseconds = null)
    {
        if (!is_null($milliseconds)) {
            $this->config['timer'] = $milliseconds;
        }

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
    public function persistent($button = 'OK', $closeOnClickOutside = true)
    {
        if (is_array($button)) {
            $this->config['buttons'] = $button;
        } else {
            $this->config['button'] = $button;
        }

        $this->config['closeOnClickOutside'] = $closeOnClickOutside;
        $this->removeTimer();
        $this->flashConfig();

        return $this;
    }

    /**
     * Remove the timer config option.
     *
     * @return void
     */
    protected function removeTimer()
    {
        if (array_key_exists('timer', $this->config)) {
            unset($this->config['timer']);
        }
    }

    /**
     * Flash the current alert configuration to the session store.
     *
     * @return void
     */
    protected function flashConfig()
    {
        foreach ($this->config as $key => $value) {
            $this->session->flash("sweet_alert.{$key}", $value);
        }

        $this->session->flash('sweet_alert.alert', $this->buildJsonConfig());
    }

    /**
     * Return the current alert configuration.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Return the current alert configuration as Json.
     *
     * @return string
     */
    public function getJsonConfig()
    {
        return $this->buildJsonConfig();
    }

    /**
     * Build the configuration as Json.
     *
     * @return string
     */
    protected function buildJsonConfig()
    {
        $config = $this->config;

        // If the alert config has no title, it will switch the text for the title.
        // We are using a copy of the config to prevent messing the instance config.
        if (!$this->hasTitle()) {
            $config = $this->switchTitle($config);
        }

        return json_encode($config);
    }

    /**
     * Determine if the title is set.
     *
     * @return bool
     */
    protected function hasTitle()
    {
        return (bool) strlen($this->config['title']);
    }

    /**
     * Switch the text message to the title key.
     *
     * @return void
     */
    protected function switchTitle($config)
    {
        $config['title'] = $config['text'];

        unset($config['text']);

        return $config;
    }
}
