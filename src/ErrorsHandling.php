<?php

namespace Saverty\ErrorsHandling;

use Saverty\ErrorsHandling\Traits\ErrorsHandlingTrait;
class ErrorsHandling
{
    use ErrorsHandlingTrait;

    public const TABLE = "errors_handling";
    public $errors;

    /**
     * ErrorsHandling constructor.
     */
    public function __construct()
    {
        $this->errors = [];
    }




}