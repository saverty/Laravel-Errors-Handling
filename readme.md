# Laravel Errors Handling

Laravel Errors Handling allow you to manage errors codes. Sometimes HTTP status aren't enought. With this package you can create your own status with a short description to share it with your team.

# Installation
**Install the package using composer**

    composer require saverty/errors_handling

**Publish the configuration**

    php artisan vendor:publish --provider="Saverty\ErrorsHandling\ErrorsHandlingServiceProvider" --tag="config"

**Go to your app.php and add the provider**

    "providers"[
		...
	    Saverty\ErrorsHandling\ErrorsHandlingServiceProvider::class,
	]


## Add your codes

Go to errors_handling.php config file and follow the example. Your codes can be grouped by category. 
Each code needs a code, a name and a description


## Return the code in the response
**Use the package**

    use Saverty\ErrorsHandling\ErrorsHandling;
    
**Return the code error**

    $errors = new ErrorsHandling();
    
    $errors->add("AUTH001")->add("AUTH002")->add("AUTH002");
    
    return response()->json([
       "codeErrors" => $errors->toArray()
       ]
    );
    



## Your documentation

You can see the all your codes at this url : {your_domain}/errorshandling

