<?php

namespace eru\SweetAlert;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \eru\SweetAlert\SweetAlertNotifier message(string $text = '', $title = null, $icon = null)
 * @method static \eru\SweetAlert\SweetAlertNotifier basic(string $text, string $title)
 * @method static \eru\SweetAlert\SweetAlertNotifier info(string $text, string $title = '')
 * @method static \eru\SweetAlert\SweetAlertNotifier success(string $text, string $title = '')
 * @method static \eru\SweetAlert\SweetAlertNotifier error(string $text, string $title = '')
 * @method static \eru\SweetAlert\SweetAlertNotifier warning(string $text, string $title = '')
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
        return 'eru.sweet-alert';
    }
}
