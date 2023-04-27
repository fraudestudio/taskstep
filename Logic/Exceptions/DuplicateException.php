<?php

namespace TaskStep\Logic\Exceptions;

use Exception;

/**
 * Exception à lever suite à une tentative d'insérer plusieurs fois la même donnée
 */
class DuplicateException extends Exception { }