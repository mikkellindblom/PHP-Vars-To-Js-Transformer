# Laravel js helper class

## Installation

Begin by installing this package through Composer.

```bash
composer require mikkellindblom/laravel-js-helper
```

### Ussage

When this provider is booted, you'll gain access to a helpful `JavaScript` facade, which you may use in your controllers.

```php
public function index()
{
    JavaScript::put([
        'foo' => 'bar',
        'user' => User::first(),
        'age' => 29
    ]);

    return View::make('hello');
}
```

> In Laravel 5, of course add `use JavaScript;` to the top of your controller.

Using the code above, you'll now be able to access `foo`, `user`, and `age` from your JavaScript.

```js
console.log(foo); // bar
console.log(user); // User Obj
console.log(age); // 29
```

This package, by default, binds your JavaScript variables to a "footer" view, which you will include. For example:

```
<body>
    <h1>My Page</h1>

    @include ('footer') // <-- Variables prepended to this view
</body>
```

Naturally, you can change this default to a different view. See below.

### Defaults

If using Laravel, there are only two configuration options that you'll need to worry about. First, publish the default configuration.

```bash
php artisan vendor:publish

// Or...

php artisan vendor:publish --provider="Mikkellindblom\js-helper\JavaScript\JavaScriptServiceProvider"
```

This will add a new configuration file to: `config/javascript.php`.

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View to Bind JavaScript Vars To
    |--------------------------------------------------------------------------
    |
    | Set this value to the name of the view (or partial) that
    | you want to prepend all JavaScript variables to.
    |
    */
    'bind_js_vars_to_this_view' => 'footer',

    /*
    |--------------------------------------------------------------------------
    | JavaScript Namespace
    |--------------------------------------------------------------------------
    |
    | By default, we'll add variables to the global window object. However,
    | it's recommended that you change this to some namespace - anything.
    | That way, you can access vars, like "SomeNamespace.someVariable."
    |
    */
    'js_namespace' => 'window'

];
```

#### bind_js_vars_to_this_view

You need to update this file to specify which view you want your new JavaScript variables to be prepended to. Typically, your footer is a good place for this.

If you include something like a `layouts/partials/footer` partial, where you store your footer and script references, then make the `bind_js_vars_to_this_view` key equal to that path. Behind the scenes, the Laravel implementation of this package will listen for when that view is composed, and essentially paste the JS variables within it.

#### js_namespace

By default, all JavaScript vars will be nested under the global `window` object. You'll likely want to change this. Update the
`js_namespace` key with the name of your desired JavaScript namespace. It can be anything. Just remember: if you change this setting (which you should),
then you'll access all JavaScript variables, like so:

```js
MyNewNamespace.varName
```

#### Note
Run this artisan command after changing the view path.
```
php artisan config:clear
```

## License

[View the license](https://github.com/mikkellindblom/laravel-js-helper/blob/master/LICENSE) for this repo.
