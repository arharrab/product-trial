<?php

// src/Security/JWTAuthenticator.php
namespace App\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Security\Authenticator\JWTAuthenticator as BaseJWTAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class JWTAuthenticator extends BaseJWTAuthenticator
{
    // Tu peux redéfinir des méthodes ici si tu veux
}
