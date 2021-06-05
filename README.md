# Laravel-Uuid
Eloquent UUID Trait for Laravel 6 and above.

## Installation

	composer require devkylian/laravel-uuid

## Usage

#### Add this in your migrations

```php
Schema::create('users', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('username');
    $table->string('email')->unique();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
```

#### Add this in your models

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DevKylian\Uuid\HasUuid;

class User extends Model
{
    use HasUuid;
}
```