<?php

Route::get('errorshandling/errors', function(){
    $data = array(
        "errors" => Saverty\ErrorsHandling\ErrorsHandling::errors()
    );
   return view('errors_handling::errors')->with(compact('data'));
});

Route::get('errorshandling/logs', function(){
    $data = array(
        "logs" => Saverty\ErrorsHandling\ErrorsHandling::getAllLogs()
    );
    return view('errors_handling::logs')->with(compact('data'));
});


