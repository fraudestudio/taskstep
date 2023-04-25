<?php

namespace TaskStep\Logic\Exceptions;

use Exception;

/**
 * Classe d'exception à utiliser quand le token n'est plus bon, déconnexion nécessaire 
 */
class TokenOutOfDateException extends Exception
{

    public function __construct()
    {

        parent::__construct("Token dépassé");

    }

}