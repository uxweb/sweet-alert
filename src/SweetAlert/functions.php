<?php

if (! function_exists('alert')) {

    /**
     * Arrange for an alert message.
     *
     * @param  string|null $message
     * @return \UxWeb\SweetAlert\SweetAlertNotifier
     */
    function alert($message = null)
    {
        $notifier = app('uxweb.sweet-alert');

        if (! is_null($message)) {
            return $notifier->message($message);
        }

        return $notifier;
    }
}
