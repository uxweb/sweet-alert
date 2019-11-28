<?php

namespace UxWeb\SweetAlert;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \UxWeb\SweetAlert\SweetAlertNotifier message(string $text = '', $title = null, $icon = null)
 * @method static \UxWeb\SweetAlert\SweetAlertNotifier basic(string $text, string $title)
 * @method static \UxWeb\SweetAlert\SweetAlertNotifier info(string $text, string $title = '')
 * @method static \UxWeb\SweetAlert\SweetAlertNotifier success(string $text, string $title = '')
 * @method static \UxWeb\SweetAlert\SweetAlertNotifier error(string $text, string $title = '')
 * @method static \UxWeb\SweetAlert\SweetAlertNotifier warning(string $text, string $title = '')
 */
class SweetAlert extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'uxweb.sweet-alert';
    }
}
