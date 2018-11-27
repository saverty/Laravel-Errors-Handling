<?php

namespace Saverty\ErrorsHandling\Traits;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
     * @param null $group
     * @return $this
     */
    public function add($code, $group = null){
        if(is_null($group)){
            if(!$this->errorIsSet($code)){
                $this->errors[$code] =  $this->getError($code);
            }
        }else{
            if(!$this->errorIsSet($code)){
                $this->errors[$group][$code] =  $this->getError($code);
            }
        }

        $this->logError($code);
        return $this;
    }

    /**
     * Check if an error is present
     * @return bool
     */
    public function hasErrors(){
        if(sizeof($this->toArray()) > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Transform a laravel validator to ErrorsHandling
     * @param $validator
     */
    public function injectValidator($validator){
        foreach($validator->messages()->messages() as $group => $errors){
            foreach ($errors as $error){
                $this->add($error, $group);
            }
        }
    }

    /**
     * Log error
     * @param $code
     * @return bool
     */
    protected function logError($code){
        $error = self::getError($code);
        if(key_exists("log", $error)){
            if($error['log'] == true){
                DB::table(self::TABLE)->insert(
                    [
                        'code' => $code,
                        'environment' => config('app.env'),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]
                );
                return true;
            }
        }
        return false;
    }

    /**
     * Get all logs as an eloquent instance
     * @return \Illuminate\Support\Collection
     */
    public static function getAllLogs(){
        return Db::table(self::TABLE)
            ->select('*')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get errors groups
     * @return array
     */
    public static function getGroups(){
        $groups = array();

        foreach(self::errors() as $group => $error){
            array_push($groups, strtolower($group));
        }

        return $groups;
    }

    /**
     * Get errors inside a group
     * @param $group
     * @return array
     */
    public static function getErrorsGroups($group){
        $errors = array();
        foreach (self::errors()[$group] as $key => $error){
            array_push($errors, [
                $key => $error
            ]);
        }

        return $errors;

    }
}