# Laravel Sift

Sensible key-value query filtering for your Laravel application.

Basic example:

```php
<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Samrap\Sift\QueryFilters;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $filters = new QueryFilters($request->all());

        return response()->json(User::sift($filters)->get());
    }
}

```

## Installation

Laravel Sift is available on Packagist:

```
composer require samrap/laravel-sift
```

## Usage

Coming soon.
