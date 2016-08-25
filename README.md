# Gravatar
A simple [gravatar](https://en.gravatar.com/) class.

## Installation

### Step 1: Add the following package to your composer.json.
    require {
      "taskforcedev/gravatar": "1.0.*",
    }

### Step 2: Run composer update.
    composer update

## Usage
Using the class is as very straightforward.

Example

    use Taskforcedev\Gravatar;

    $gravatar = new Gravatar();

    $avatar = $gravatar->getAvatar($user, $options);

$user can be any of the following:
 - An array with a key containing the email address.
 - A Laravel User object.
 - A class with a getEmail() method or email property.

$options is optional
 - $options['secure'] - By default this is true for https but can also be set to false for http.
 - $options['size'] - Defaults to 100 (px), accepts any int value.

### Exceptions
If for any reason the class fails to retrieve a gravatar false will be returned.
