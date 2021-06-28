# Hoss Laravel Middlware

Middleware for PHP Laravel (> 5.1) to automatically log API Calls and
sends to [Hoss](https://www.hoss.com) for API analytics and log analysis

## How to install

Via Composer + Git

Include the following repository reference to your composer.json file
```json
"repositories": [
    {
        "url": "https://github.com/hossapp/php-laravel-middleware.git",
        "type": "git"
    }
]
```

And then, install the hossapp laravel middleware
```bash
$ composer require hossapp/hossapp-laravel
```
or add 'hossapp/hossapp-laravel' to your composer.json file accordingly.

## How to use

### Add Service Provider

```php

// In config/app.php

'providers' => [
  /*
   * Application Service Providers...
   */
    Hossapp\Middleware\HossappLaravelServiceProvider::class,
];
```

### Add to Middleware

If website root is your API, add to the root level:

```php

// In App/Http/Kernel.php

protected $middleware = [
  /*
   * The application's global HTTP middleware stack.
   *
   * These middleware are run during every request to your application.
   */
   \Hossapp\Middleware\HossappLaravel::class,
];

```

If you only want to add tracking for APIs under specific route group, add to your route group, but be sure to remove from the global
middleware stack from above global list.

```php
// In App/Http/Kernel.php

protected $middlewareGroups = [
  /**
   * The application's API route middleware group.
   */
   'api' => [
        //
        \Hossapp\Middleware\HossappLaravel::class,
    ],
];
```

To track only certain routes, use route specific middleware setup.


### Publish the package config file

```bash
$ php artisan vendor:publish --provider="Hossapp\Middleware\HossappLaravelServiceProvider"
```

### Setup config

Edit `config/hossapp.php` file.

```php

// In config/hossapp.php

$identifyUserId = function($request, $response) {
    // Your custom code that returns a user id string
    $user = $request->user();
    if ($request->user()) {
        return $user->id;
    }
    return NULL;
};

$identifyCompanyId = function($request, $response) {
    // Your custom code that returns a company id string
    return 1;
};

$skip = function($request, $response) {
    // Determine if logging this API request should be skipped
    return false;
};

return [
    'applicationId' => 'Your Hoss Application Id',
    'logBody' => true,
    'identifyUserId' => $identifyUserId,
    'identifyCompanyId' => $identifyCompanyId,
    'skip' => $skip,
];
```
