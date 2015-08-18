<?php namespace Taskforcedev\Gravatar;

class Gravatar
{
    private $http_url;
    private $https_url;

    public function __construct()
    {
        $this->http_url = 'http://www.gravatar.com/avatar/';
        $this->https_url = 'https://secure.gravatar.com/avatar/';
    }

    /**
     * Retrieves a users gravatar using their email address
     *
     * @param mixed $user    Accepts a laravel user object, an array or a php object.
     * @param array $options Check readme for full options.
     *
     * @return bool|string
     */
    public function getAvatar($user, $options = [])
    {
        if (!isset($options['size'])) {
            $options['size'] = 100;
        }

        if (!isset($options['secure'])) {
            $options['secure'] = true;
        }

        try {
            if (method_exists('getEmail', $user)) {
                $email = $user->getEmail();
            } elseif (isset($user->email)) {
                $email = $user->email;
            } elseif (isset($user['email'])) {
                $email = $user['email'];
            }

            $hash = $this->getHash($email);

            if ($options['secure']) {
                $avatar_url = $this->https_url . $hash . '?s=' . $options['size'];
            } else {
                $avatar_url = $this->http_url . $hash . '?s=' . $options['size'];
            }

            return $avatar_url;
        } catch(Exception $e) {
            return false;
        }
    }

    /**
     * Get the gravatar hash from an email address.
     *
     * @param $email
     *
     * @return bool|string
     */
    private function getHash($email)
    {
        try {
            $gravatar_hash = md5(strtolower(trim($email)));
            return $gravatar_hash;
        } catch(Exception $e) {
            return false;
        }
    }
}
