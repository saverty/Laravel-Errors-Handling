<?php

namespace Saverty\ErrorsHandling;

use Saverty\ErrorsHandling\Traits\ErrorsHandlingTrait;
class ErrorsHandling
{
    use ErrorsHandlingTrait;

    public $error;
    public $code;

    /**
     * ErrorsHandling constructor.
     * @param $error
     * @param $code
     */
    public function __construct($error, $code)
    {
        $this->error = $error;
        $this->code = $code;
    }


}