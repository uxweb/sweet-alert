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
    private $config = [];

    /**
     * @param SessionStore $session
     */
    function __construct(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Displays a simple alert with a message and an optional title
     *
     * @param $message
     * @param string $type
     * @param null $title
     * @return $this
     */
    public function message($message, $type = 'info', $title = null)
    {
        $this->config['message'] = $message;
        $this->config['type'] = $type;
        $this->config['title'] = $title;

        $this->flashConfig();

        return $this;
    }

    /**
     * Displays a success alert
     *
     *
     * @param $message
     * @param string $title
     * @return $this
     */
    public function success($message, $title = 'Success!')
    {
        $this->message($message, 'success', $title);

        return $this;
    }

    /**
     * Displays an error alert
     *
     * @param $message
     * @param string $title
     * @return $this
     */
    public function error($message, $title = "Oops!")
    {
        $this->message($message, 'error', $title);

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
        $this->session('timer', $milliseconds);
        $this->flashConfig();

        return $this;
    }

    /**
     * Flashes the current built configuration for sweet alert
     */
    public function flashConfig()
    {
        $this->session('sweet_alert.alert', json_encode($this->config));
    }
}
