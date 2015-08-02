<?php

namespace UxWeb\SweetAlert;

class SweetAlertNotifier
{
    /**
     * @var SessionStore
     */
    private $session;

    /**
     * @var array
     */
    private $config = [
        'showConfirmButton' => false,
        'timer' => 1800,
        'allowOutsideClick' => true,
    ];

    /**
     * @param SessionStore $session
     */
    public function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Displays a simple alert with a message and an optional title
     *
     * @param $text
     * @param string $type
     * @param string $title
     * @return $this
     */
    public function message($text, $title = '', $type = null)
    {
        $this->config['text']  = $text;
        $this->config['title'] = $title;
        $this->config['type']  = $type;

        $this->flashConfig();

        return $this;
    }

    /**
     * Displays a basic alert message
     *
     * @param $text
     * @param $title
     * @return $this
     */
    public function basic($text, $title)
    {
        $this->message($text, $title);

        return $this;
    }

    /**
     * Displays a info alert
     *
     *
     * @param $text
     * @param string $title
     * @return $this
     */
    public function info($text, $title = '')
    {
        $this->message($text, $title, 'info');

        return $this;
    }

    /**
     * Displays a success alert
     *
     *
     * @param $text
     * @param string $title
     * @return $this
     */
    public function success($text, $title = '')
    {
        $this->message($text, $title, 'success');

        return $this;
    }

    /**
     * Displays an error alert
     *
     * @param $text
     * @param string $title
     * @return $this
     */
    public function error($text, $title = '')
    {
        $this->message($text, $title, 'error');

        return $this;
    }
    
    /**
     * Displays a warning alert
     *
     *
     * @param $text
     * @param string $title
     * @return $this
     */
    public function warning($text, $title = '')
    {
        $this->message($text, $title, 'warning');
        return $this;
    }

    /**
     * Sets the time for this alert to close
     *
     * @param int $milliseconds
     * @return $this
     */
    public function autoclose($milliseconds = 2000)
    {
        $this->config['timer'] = $milliseconds;
        $this->flashConfig();

        return $this;
    }

    /**
     * Shows an alert that prevents autoclosing
     *
     * @param string $buttonText
     * @return $this
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
     * Flashes the current built configuration for sweet alert
     */
    private function flashConfig()
    {
        foreach ($this->config as $key => $value) {
            $this->session->flash("sweet_alert.{$key}", $value);
        }

        $this->session->flash('sweet_alert.alert', $this->buildConfig());
    }

    /**
     * Build the configuration for the alert
     * @return string
     */
    private function buildConfig()
    {
        return $this->getCompound();
    }

    /**
     * Returns configuration for a basic alert
     * @return string
     */
    private function getBasic()
    {
        return json_encode($this->config['text']);
    }

    /**
     * Returns configuration for an alert with title and text under
     * @return string
     */
    private function getTitleAndText()
    {
        return json_encode($this->config['title']).",".json_encode($this->config['text']);
    }

    /**
     * Returns all the configuration options for an alert
     * @return string
     */
    private function getCompound()
    {
        if (! $this->hasTitle()) {
            $this->config['title'] = $this->config['text'];
            unset($this->config['text']);
        }

        return json_encode($this->config);
    }

    /**
     * Tells if a title is set
     * @return bool
     */
    private function hasTitle()
    {
        return (bool) strlen($this->config['title']);
    }
}
