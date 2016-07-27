<?php

namespace UxWeb\SweetAlert;

use Closure;
use SweetAlertNotifier as Alert;

class ConvertMessagesIntoSweatAlert
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('success')){
            Alert::success($request->session()->get('success'), 'Success')->persistent();
        }

        if($request->session()->has('warning')){
            Alert::success($request->session()->get('warning'), 'Warning')->persistent();
        }

        if($request->session()->has('info')){
            Alert::success($request->session()->get('info'), 'Info')->persistent();
        }

        if($request->session()->has('message')){
            Alert::success($request->session()->get('message'))->persistent();
        }

        if($request->session()->has('basic')){
            Alert::success($request->session()->get('basic'));
        }

        if($request->session()->has('errors')){
            $message = $this->prepareErrors($request->session()->get('errors')->getMessages());

            Alert::error($message, 'Errors')->persistent();
        }

        return $next($request);
    }

    /**
     * Retrieve the errors from ViewErrorBag
     *
     * @param $errors
     * @return string
     */
    private function prepareErrors($errors){
        $errors = collect($errors);

        return $errors->flatten()->implode('<br />');
    }
}

