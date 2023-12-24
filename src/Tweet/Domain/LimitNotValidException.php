<?php

namespace App\Tweet\Domain;

class LimitNotValidException extends \Exception
{
    public function __construct(int $limit)
    {
        $message = sprintf('limit %s is not valid, valid value (0-10)', $limit);
        parent::__construct($message);
    }
}