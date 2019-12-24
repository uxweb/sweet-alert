<?php

namespace UxWeb\SweetAlert;

use Illuminate\Session\Store;

class LaravelSessionStore implements SessionStore
{
    /**
     * @var Store
     */
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Flash some data into the session.
     *
     * @param string $key
     * @param $value
     */
    public function flash(string $key, $value = true)
    {
        $this->session->flash($key, $value);
    }

    /**
     * Remove an item from the session.
     *
     * @param  string|array  $keys
     */
    public function remove($keys)
    {
        $this->session->forget($keys);
    }
}
