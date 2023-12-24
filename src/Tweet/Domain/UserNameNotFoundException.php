<?php

namespace App\Tweet\Domain;

class UserNameNotFoundException extends \Exception
{
    public function __construct(string $username)
    {
        $message = sprintf('Username %s not found', $username);
        parent::__construct($message);
    }
}