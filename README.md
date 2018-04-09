# LaravelUserManagement

A simple package for Laravel that provides user management services

## Installation

Install this package with composer using the following command:

```
composer require techlify-inc/laravel-user-management
```

Run migrations

```
$ php artisan migrate
```

## Usage

This package provides the following API services that your frontend can use: 

### User Management

```php

// Get the set of users
GET api/users

// Get a single user
GET api/users/{id}

// Add a new user
POST api/users

// Update a user record
PATCH api/users/{id}

// Delete a user record
DELETE api/users/{id}

```


### User Password Management

```php

// Change the current user password
POST api/user/current/update-password {current_password, new_password}

```

### User Session Management

```php

// Log out the currently logged in user
POST api/user/logout

// Get the User record of the currently logged in user
GET api/user/current

```