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
 
    return [
        //Group your codes 
        "Authentifcation" => [
        
            //Detail your code
            "AUTH001" => [
                "name" => "Login Fail",
                "description" => "Email or password is wrong"
            ]
         ]
    ]

**Use the package**

    use Saverty\ErrorsHandling\ErrorsHandling;
    
**Add a code error**

    $errors = new ErrorsHandling();
    
    $errors->add("AUTH001");

**Add multiple errors**

    $errors = new ErrorsHandling();
    $errors->add('AUTH001')->add('AUTH002');
    
**Group your errors**
    
    $errors = new ErrorsHandling();
    
    $errors->add('AUTH001', 'email')->add('AUTH002','email');
    $errors->add('AUTH003', 'name')->add('AUTH004','name');
 
 **Check if errors are presents**
 
    if($errors->hasErrors()){
        //Errors 
    }else{
        // No errors
    }
    
**Return errors as an array**

    $errors->toArray();
    
    
**Return errors as a Json**
    
    $errors->toJson();
    
**Use the laravel validator**

     $validator = Validator::make($request->all(),
            [
                "email" => ['required', 'integer'],
                "password" => ['required', 'email']
            ],
            [
                "email.integer" => "AUTH001"
            ]
     );
    
     $errors->injectValidator($validator);
     
   
## Your documentation

You can see the all your codes at this url : {your_domain}/errorshandling

