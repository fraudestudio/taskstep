<?php

namespace TaskStep\Logic\Exceptions;

use Exception;

class BadTokenException extends Exception
{

    public function __construct(){
        parent::__construct("Le token n'est pas valide");
    }

}