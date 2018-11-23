<?php

Route::get('errorshandling', function(){
    $data = array(
        "errors" => Saverty\ErrorsHandling\ErrorsHandling::errors()
    );
   return view('errors_handling::list')->with(compact('data'));
});