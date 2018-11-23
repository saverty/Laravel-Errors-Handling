<?php

namespace Saverty\ErrorsHandling\Traits;


trait ErrorsHandlingTrait
{
    /**
     * Get errors
     * Get all errors in the config file
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function errors(){
        return config('errors_handling');
    }

    /**
     * find a specific error
     * Return the error using his code
     * @param $code
     * @return mixed
     */
    private static function getError($code){
        $errors = self::errors();
        foreach ($errors as $group => $errs){
            foreach ($errors[$group] as $codeErr => $err){
                if($code == $codeErr){
                    return $err;
                }
            }
        }
    }

    /**
     * Get Error instance
     * Return the instance error using the code
     * @param $code
     * @return ErrorsHandling::class
     */
    public static function error($code){
        $error = self::getError($code);
        return new self($error, $code);
    }

    /**
     * Transform error to array
     * @return array
     */
    public function toArray(){
        return [
            $this->code => $this->error
        ];
    }

    /**
     * Transform error to Json
     * @return string
     */
    public function toJson(){
        return json_encode($this->toArray());
    }
}