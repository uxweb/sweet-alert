<?php

namespace UxWeb\SweetAlert;

interface SessionStore
{
    /**
     * Flash some data into the session.
     *
     * @param $name
     * @param $data
     */
    public function flash(string $key, $value = true);

    /**
     * Remove an item from the session.
     *
     * @param  string|array  $keys
     */
    public function remove($keys);
}
