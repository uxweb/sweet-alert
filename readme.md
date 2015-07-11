# Easy Sweet Alert Messages

## Installation

First, pull in the package through Composer.

```javascript
"require": {
    "uxweb/sweet-alert": "~1.0"
}
```

If using Laravel 5, include the service provider within `app/config/app.php`.

```php
'providers' => [
    'UxWeb\SweetAlert\SweetAlertServiceProvider'
];
```

And, for convenience, add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'Alert' => 'Uxweb\SweetAlert\SweetAlert'
];
```

> Note that this package works only by using the [BEAUTIFUL REPLACEMENT FOR JAVASCRIPT'S "ALERT"](http://t4t5.github.io/sweetalert/).

Finally, you need to get the Sweet Alert library, you can so by:

Download the .js and .css from the [website](http://t4t5.github.io/sweetalert/)

Or through bower:

```bash
bower install sweetalert
```
    
## Usage

Within your controllers, before you perform a redirect...

```php
public function store()
{
    Alert::message('Welcome Back!');

    return Redirect::home();
}
```

You may also do:

- `Alert::success('Message', 'title')`
- `Alert::error('Message', 'title')`

Alternatively, again, if you're using Laravel, you may reference the `alert()` helper function, instead of the facade. Here's an example:

```php
/**
 * Destroy the user's session (logout).
 *
 * @return Response
 */
public function destroy()
{
    Auth::logout();

    alert()->success('You have been logged out.', 'Good bye!');

    return home();
}
```

Or, for a general information alert, just do: `alert('Some message');`.

By default, all alerts will dismiss after a sensible default number of seconds.

But no fear, if you need to specify a different time you can!:

```php
alert('Hello World!')->autoclose(3000); // -> Remember!, the number is set in milliseconds
```

Also, if you need the alert to be persistent on the page until the user dismiss it:

```php
alert('Hello World!')->persistent("Close this"); // -> The text passed is for the button
```

Note that, if you want, you may use (or modify) the view that is included with this package. Simply append it to your layout view:

```html
@include('sweet::alert')
```

## Example

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sweetalert.css">
</head>
<body>

    <div class="container">
        <p>Welcome to my website...</p>
    </div>
    
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    
    <!-- Include this after you include the sweet alert js file -->
    @include('sweet::alert')

</body>
</html>
```

If you need to modify the alert message partial, you can run:

```bash
php artisan vendor:publish
```

The package view will now be located in the `app/views/packages/uxweb/sweet/` directory.

Now you can build your sweet alert configuration as you wish, for example:

```html
@if (Session::has('sweet_alert.alert'))
    <script>
        swal({{ Session::get('sweet_alert.alert') }});
    </script>
@endif
```

The `sweet_alert.alert` session key contains a JSON configuration object to pass it directly to sweetAlert.

If you are building your own configuration, you still can access some of the variable configuration values like:

    Session::get('sweet_alert.text')
    Session::get('sweet_alert.type')
    Session::get('sweet_alert.title')

Now you can build your own sweet alert:

```html
@if (Session::has('sweet_alert.alert'))
    <script>
        swal({
            text: {{ Session::get('sweet_alert.text') }},
            title: {{ Session::get('sweet_alert.title') }},
            timer: {{ Session::get('sweet_alert.timer') }},
            // More options ...
        });
    </script>
@endif
```

If you want to know all options to configure sweet alert please check the CONFIGURATION section in the [website](http://t4t5.github.io/sweetalert/)

```php
Alert::message('Welcome back!');

return Redirect::home();
```

```php
Alert::error('Sorry! Please try again.');

return Redirect::home();
```

```php
Alert::success('You are now a new member!', 'Thank you!');

return Redirect::home();
```
