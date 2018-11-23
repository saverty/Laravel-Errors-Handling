<?php

namespace Saverty\ErrorsHandling;

use Saverty\ErrorsHandling\Traits\ErrorsHandlingTrait;
class ErrorsHandling
{
    use ErrorsHandlingTrait;

    public $errors;

    /**
     * ErrorsHandling constructor.
     * @param $error
     * @param $code
     */
    public function __construct()
    {
        $this->errors = [];
    }


}