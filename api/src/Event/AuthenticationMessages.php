<?php declare(strict_types=1);

namespace App\Event;

final class AuthenticationMessages
{
    /**
     * The AUTHENTICATION_SUCCESS event occurs after a user is authenticated
     * by one provider.
     *
     * @Event("App\Event\Event\AuthenticationEvent")
     */
    public const AUTHENTICATION_SUCCESS = 'app.authentication.success';
}
