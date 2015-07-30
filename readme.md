# Easy Sweet Alert Messages for Laravel

![A success modal](http://i.imgur.com/1XySJiz.png)

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
    'Alert' => 'UxWeb\SweetAlert\SweetAlert'
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

### With the Facade

- `Alert::message('Message', 'title')`
- `Alert::success('Message', 'title')`
- `Alert::error('Message', 'title')`

Within your controllers, before you perform a redirect...

```php
public function store()
{
    Alert::message('Welcome Back!');

    return Redirect::home();
}
```

### With the Helper

- `alert('Message')`
- `alert()->message('Message')`
- `alert()->success('Message', 'title')`
- `alert()->error('Message', 'title')`

Alternatively, if you're using Laravel, you may reference the `alert()` helper function, instead of the facade. Here's an example:

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

For a general information alert, just do: `alert('Some message');` (same as `alert->message('Some message');`).

By default, all alerts will dismiss after a sensible default number of seconds.

But no fear, if you need to specify a different time you can:

```php
    // -> Remember!, the number is set in milliseconds
    alert('Hello World!')->autoclose(3000);
```

Also, if you need the alert to be persistent on the page until the user dismiss it by pressing the alert confirmation button:

```php
    // -> The text will appear in the button
    alert('Hello World!')->persistent("Close this");
```

Finally, to display the alert in the browser, you may use (or modify) the view that is included with this package. Simply append it to your layout view:

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
    <link rel="stylesheet" href="css/sweetalert.css">
</head>
<body>

    <div class="container">
        <p>Welcome to my website...</p>
    </div>
    
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="js/sweetalert.min.js"></script>
    
    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')

</body>
</html>
```

If you need to modify the alert message partial, you can run:

```bash
    php artisan vendor:publish
```

The package view will now be located in the `resources/views/vendor/sweet/` directory.

Now you can build your sweet alert configuration as you wish, for example:

```html
@if (Session::has('sweet_alert.alert'))
    <script>
        swal({!! Session::get('sweet_alert.alert') !!});
    </script>
@endif
```

The `sweet_alert.alert` session key contains a JSON configuration object to pass it directly to Sweet Alert.

Note that {!! !!} are used to output unescaped json object, it will not work with {{ }} escaped output tags.

If you are building your own configuration, you still can access some of the variable configuration values like:

    Session::get('sweet_alert.text')
    Session::get('sweet_alert.type')
    Session::get('sweet_alert.title')
    Session::get('sweet_alert.timer')

Now you can build your own sweet alert:

```html
@if (Session::has('sweet_alert.alert'))
    <script>
        swal({
            text: "{!! Session::get('sweet_alert.text') !!}",
            title: "{!! Session::get('sweet_alert.title') !!}",
            timer: {!! Session::get('sweet_alert.timer') !!},
            showConfirmButton: false,
            type: 'success'
            // more options
        });
    </script>
@endif
```

If you want to know all options to configure sweet alert please check the CONFIGURATION section in the [website](http://t4t5.github.io/sweetalert/)

```php
Alert::message('Welcome back!');

return Redirect::home();
```
![A info alert](http://i.imgur.com/K2gGW0a.png)


```php
Alert::error('Sorry! Please try again.');

return Redirect::home();
```
![A error alert](http://i.imgur.com/FH8d5F3.png)


```php
Alert::success('You are now a new member!', 'Thank you!');

return Redirect::home();
```
![A success alert](http://i.imgur.com/1XySJiz.png)


```php
Alert::success('Hello World!')->persistent("Close this");

return Redirect::home();
```
![A persist alert](http://i.imgur.com/4ggrLfR.png)
