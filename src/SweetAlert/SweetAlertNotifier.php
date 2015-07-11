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
    public function message($text, $type = 'info', $title = '')
    {
        $this->config['text'] = $text;
        $this->config['type'] = $type;
        $this->config['title'] = $title;

        $this->flashConfig();

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
    public function success($text, $title = 'Success!')
    {
        $this->message($text, 'success', $title);

        return $this;
    }

    /**
     * Displays an error alert
     *
     * @param $text
     * @param string $title
     * @return $this
     */
    public function error($text, $title = "Oops!")
    {
        $this->message($text, 'error', $title);

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
        $this->config['timer'] = null;
        $this->flashConfig();

        return $this;
    }

    /**
     * Flashes the current built configuration for sweet alert
     */
    public function flashConfig()
    {
        foreach ($this->config as $key => $value) {
            $this->session->flash("sweet_alert.{$key}", $value);
        }

        $this->session->flash('sweet_alert.alert', json_encode($this->config));
    }
}
