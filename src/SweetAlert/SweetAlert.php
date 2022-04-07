<?php

namespace erfan\SweetAlert;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \erfan\SweetAlert\SweetAlertNotifier message(string $text = '', $title = null, $icon = null)
 * @method static \erfan\SweetAlert\SweetAlertNotifier basic(string $text, string $title)
 * @method static \erfan\SweetAlert\SweetAlertNotifier info(string $text, string $title = '')
 * @method static \erfan\SweetAlert\SweetAlertNotifier success(string $text, string $title = '')
 * @method static \erfan\SweetAlert\SweetAlertNotifier error(string $text, string $title = '')
 * @method static \erfan\SweetAlert\SweetAlertNotifier warning(string $text, string $title = '')
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
        return 'erfan.sweet-alert';
    }
}
