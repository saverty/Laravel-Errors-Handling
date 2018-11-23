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
     * Transform error to array
     * @return array
     */
    public function toArray(){
        $result = [];
        foreach ($this->errors as $code => $err){
            $result[$code] = $err;
        }
        return $result;
    }

    /**
     * Transform error to Json
     * @return string
     */
    public function toJson(){
        return json_encode($this->toArray());
    }

    /**
     * Check if the error is already registred
     * @param $code
     * @return bool
     */
    public function errorIsSet($code){
        foreach ($this->errors as $c => $e){
            if($c == $code){
                return true;
            }
        }
        return false;
    }

    /**
     * Add an error
     * @param $code
     * @return $this
     */
    public function add($code){
        if(!$this->errorIsSet($code)){
            $this->errors[$code] =  $this->getError($code);
        }
        return $this;
    }
}