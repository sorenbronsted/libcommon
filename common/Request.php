<?php

namespace sbronsted;

/**
 * Class Request helps managing cookie information and authentication tokens.
 */
class Request
{
    /**
     * Checks if the token is in the request.
     *
     * @param string
     *    $name the name of token to look for
     *
     * @return bool
     *    true when $_REQUEST[$name] exists otherwise false
     */
    public function hasAuthToken(string $name): bool
    {
        return isset($_REQUEST[$name]) && !empty($_REQUEST[$name]);
    }

    /**
     * Get the authentification token.
     *
     * @param string
     *    $name the name of token
     *
     * @return string|null
     *    the token if found otherwise null
     */
    public function getAuthToken(string $name): ?string
    {
        return $this->hasAuthToken($name) ? $_REQUEST[$name] : null;
    }

    /**
     * Checks if a cookie with $cookieName exists
     *
     * @param string
     *    $cookieName the of the cookie
     *
     * @return bool
     *  true if the cookie exists otherwise false
     */
    public function hasCookie(string $cookieName): bool
    {
        return isset($_COOKIE[$cookieName]) && !empty($_COOKIE[$cookieName]);
    }

    /**
     * Set the cookie with $value
     *
     * @param string $cookieName
     *    the name of the cookie
     * @param string $value
     *    the value to set
     * @param int    $ttl
     *    the time-to-live in seconds
     */
    public function setCookie(string $cookieName, string $value, int $ttl): void
    {
        setcookie($cookieName, $value, $ttl); // this does not set $_COOKIE, but only the header
        $_COOKIE[$cookieName] = $value;
    }

    /**
     *  Get the value of cookie by name
     *
     * @param string $cookieName
     *    the of the cookie
     *
     * @return string|null
     *    the value of the cookie
     */
    public function getCookie(string $cookieName): string
    {
        return $_COOKIE[$cookieName];
    }
}