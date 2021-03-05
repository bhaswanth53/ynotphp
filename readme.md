# Introduction

**YNOTPHP** is a lightweight PHP framework which is developed to make the life of developer easier. Unlike every modern
framework like **Laravel**, **Codeigniter**, etc., it doesn't contain any core to confuse the developer. That means the
entire structure is completely in the hands of the developer.

## Server Requirements

The **YNOTPHP** framework comes with few requirements as below.

* PHP >= 5.6
* Composer
* MySql PHP Extension
* PDO PHP Extension
* Fileinfo PHP Extension
* XML PHP Extension

## Getting Started

### Installation

You can directly download the framework from github url: [https://github.com/bhaswanth53/ynotphp]()

**or**

if GIT is installed on your system, you can install using the below command.

```
git clone https://github.com/bhaswanth53/ynotphp.git
```

Once, you downloaded the framework first thing you need to install packages using composer like below.

```
composer install
```

Once the packages installed you need to generate your unique APP_KEY using below command from your command shell.

```
./vendor/bin/generate-defuse-key
```

The above command will generate an hashed APP_KEY like below.

```
def000009eaeb386dcee38dacd38e1eea8cb710d2944920e7138738f8297c8d284978bb2b3a79701e6202c0d6a5561eb50e87e914fcf345ad768594788fa387bbbd0ee74
```

You need to add your app key in your env.php file as shown below.

```php
"APP_KEY" =>
"def000009eaeb386dcee38dacd38e1eea8cb710d2944920e7138738f8297c8d284978bb2b3a79701e6202c0d6a5561eb50e87e914fcf345ad768594788fa387bbbd0ee74"
```

If you are using the framework from the root folder then you need to set APP_PATH in your env.php like below.

```php
"APP_PATH" => "",
```

or if you are using the framework from any subfolder then you need to configure that subfolder path like below.

```php
"APP_PATH" => "/folder/subfolder",
```

Once you finish this, your installation will be finished and you will be redirected to homepage.

### Configuration

##### Public Directory

After installing **YNOTPHP**, you should configure your web server's document / web root to be the public directory. The
index.php in this directory serves as the front controller for all HTTP requests entering your application.

##### Environmental Variables

All the environmental variables in this framework will be configured in **env.php** file.

YNOTPHP defaultly comes with the below variables.

**APP_NAME**: This is the name of your project.

```php
"APP_NAME" => "YNOTPHP",
```

**APP_PATH**: This is the path of the application.

```php
"APP_PATH" => "/test/ynotphp",
```

**APP_KEY**: This is the unique key of the application which will be used in all trasactions regarding security.

```php
"APP_KEY" =>
"def000009eaeb386dcee38dacd38e1eea8cb710d2944920e7138738f8297c8d284978bb2b3a79701e6202c0d6a5561eb50e87e914fcf345ad768594788fa387bbbd0ee74",
```

**APP_DEBUG**: This will debug your app and log the errors into **logs** folder.

```php
"APP_DEBUG" => true,
```

**Note**: By default it is true, but you can turn it off by setting **false** in production mode.

**APP_MODE**: This is the mode of the app. Initially YNOTPHP supports 3 types of modes.

1. Development
2. Testing
3. Production

By default the mode will set to **development**.

```php
"APP_MODE" => "development",
```

##### Config Directory

Config directory contains 3 different folders.

1. development
2. testing
3. production

Each folder contains 3 different files.

1. db.php
2. mail.php
3. env.php

You can configure different database and mail configurations in different modes.

For example, if you set **APP_MODE** to **testing** then the database and mail configuration from testing folder will be
used.

# Routing

All the routes in YNOTPHP will be configured in **web.php**. YNOTPHP used [AltoRouter](http://altorouter.com/) for
routing. So you can utilize all its features. But YNOTPHP adopted latest MVC architecture along with the router, so you
can define the controller method directly from your router as shown below.

```php
// Method, URL, Controller, Name

$router->map('GET', '/', 'Controllers\\HomeController@home', 'home');
```

To define dynamic routes and URL parameters, you can check the documentation of [AltoRouter](http://altorouter.com/).

# Controllers

Instead of defining all of your request handling logic in route files, you may wish to organize this behavior using
Controller classes. Controllers can group related request handling logic into a single class. Controllers are stored in
the **app/Controllers** directory.

### Defining Controllers

Below is an example of a basic controller class. Note that the controller extends the base controller class included
with YNOTPHP. The base class provides a few convenience methods which may be used controller actions:

```php
<?php
    namespace Controllers;

    class HomeController extends Controller
    {
        public function home()
        {
            // render view
            return $this->render("home");
        }
    }
```

You can define a route to this controller action like so:

```php
$router->map('GET', '/', 'Controllers\\HomeController@home', 'home');
```

# Views

Views contain the HTML served by your application and separate your controller / application logic from your presentation logic. Views are stored in the **Views** directory. A simple view might look something like this:

```html
<html>
    <body>
        <h1>Hello, <?php echo $variable ?></h1>
</body>

</html>
```

A view will be rendered in the controller using the render method which is defined in the **Controller**.

```php
public function home()
{
return $this->render("home");
}
```

In the above code will render **home.php** inside **Views** directory. In case if the view is inside a folder in Views
directory then you can call it like below.

```php
public function home()
{
return $this->render("site.home");
}
```

Then it will look into **Views/site/home.php**.

### Passing data to views

You can pass strings and arrays to the view from the controller as shown below.

```php
public function about()
{
$name = "YNOTPHP";
$study = "10";
$data = array('args' => $args, "name" => $name, "study" => $study);
return $this->render("about", compact('name', 'study', 'data'));
}
```

And we can echo the variable in the view normally like below.

```php
<?php echo $name; ?>
```

### Better Templating

You can include view files into another just like **Laravel** blade templates.

```php
<?php parseview('layouts.site.header'); ?>
// Reset of the view code
```

The above code will include **Views/layouts/site/header.php** in your current file.

# Models

A Model is a representation of the database table. Controllers will get access to the database using Models. In YNOTPHP
we can define models like below.

```php
<?php
    // Define the namespace
    namespace Models;
    // use the DB Facade
    use Facades\DB;

    class User extends Model
    {
        public function model_function() {
            // Add the query
        }
    }
```

The model uses PDO statements to interact with database.

```php
public function update_profile_by_email($uemail, $name, $mobile, $state, $district, $city)
{
    $db = DB::open();
    $sql = "UPDATE users SET name=?, mobile=?, state=?, district=?, city=? WHERE email=?";
    $query = $db->stmt_init();
    if($query = $db->prepare($sql))
    {
        $query->bind_param('ssssss', $name, $mobile, $state, $district, $city, $uemail);
        $query->execute();
        $query->close();
    }
    return true;
}
```

```php
public function get_all()
{
    $data = array();
    $db = DB::open();
    $sql = "SELECT id, id_num, name, email, mobile, state, district, city, active, created_at FROM users ORDER BY id DESC";
    $query = $db->stmt_init();
    if($query = $db->prepare($sql))
    {
        $query->execute();
        $query->store_result();
        $query->bind_result($id, $id_num, $name, $email, $mobile, $state, $district, $city, $active, $created);
        $numrows = $query->num_rows;
        if($numrows > 0)
        {
            while($query->fetch())
            {
                $data[] = array(
                    "id" => $id,
                    "id_num" => $id_num,
                    "name" => $name,
                    "email" => $email,
                    "mobile" => $mobile,
                    "state" => $state,
                    "district" => $district,
                    "city" => $city,
                    "active" => $active,
                    "created_at" => $created
                );
            }
        }
        $query->close();
    }
    return $data;
}
```

We can use the model in the controllers like below.

```php
use Models\User;
```

Once the model is included in the Controller, then we can use all the methods in the model.

```php
public function users()
{
    // get all the users as array
    $users = User::get_all();
    return $this->render('admin.users', compact('users'));
}
```

We can use the model inside views also by directly calling the model.

```php
$users = Models\User::get_all()
```

# Facades

Facades has been develop to optimize the code need to be done for typical functionalities just like Laravel. In default, there are 6 types of facades come up with YNOTPHP. Those are:

1. Mail
2. Request
3. Validation
4. Crypt
5. DB
6. File

Lets have a quick look at what these facades are used to do.

### Mail

Mail facade is used to send emails. You can use this facade inside your controller to send emails. To use Mail facade, we must use it first in our controller.

```php
use Facades\Mail;
```

Once the facade has been used, then we are free to use it. First we need to configure the mail server in **mail.php** in your current mode inside config directory.

If you are using the application in development mode, then you need to configure mail server at **config/development/mail.php** file.

```php
return array(
    "MAIL_DRIVER" => "",
    "MAIL_HOST" => "",
    "MAIL_PORT" => "",
    "MAIL_USERNAME" => "",
    "MAIL_PASSWORD" => "",
    "MAIL_ENCRYPTION" => ""
);
```

once the configuration has been completed, then we are free to send emails.

```php
$mail = new Mail();
// We can add multiple senders using the method.
$mail->addSender("sender@gmail.com", "Sender Name");
$mail->addReceiver("receiver@gmail.com", "Receiver Name");
$mail->subject = "This is the subject";
// Body will look into mails folder inside views folder. The view file will execute is views/mails/view_name.php
$mail->body = "view_name";
// We can send arguments to the view file.
$mail->args = array(
    "url" => "This is a url parameter",
    "name" => "YNOTPHP"
);
try {
    $mail->send();
    return $this->back(); // It will return to the back page.
}
catch(Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
```

We can receive the dynamic argumants using **$args** from the mail view.

```php
<?php echo $args['url']; ?>
<?php echo $args['name']; ?>
```

### Request

Request facade is used to get form data or url parameters. Request facade is an important to use facade when you are
working with dynamic website.

```php
use Facades\Request;
```

Request facade will be used inside the controller as shown below.

```php
$request = new Request();
$token = $request->input("reset_token");
$password = $request->secure_input("password");
$confirm_password = $request->secure_input("confirm_password");
```

Request facade contains following methods.

##### input()
This method will be used to get form data normally without using any filters.

```php
$name = $request->input("input_name")
```

###### get()
This method is used to get data which has been sent using GET method or from URL parameters.

```php
$id = $request->get("id")
```

##### ajax()
This method is used to get form data which is sent using **ajax** POST requests.

```php
$name = $request->ajax("input_name")
```

##### secure_input()
This method is used to get form data in secure mode by filtering malicious chars.

```php
$name = $request->secure_input("input_name")
```

##### secure_get()
This method is used to get data from URL parameters in secure mode.

```php
$id = $request->secure_get("id")
```

##### secure_ajax()
This method is used to get data from ajax POST request in secure mode.

```php
$name = $request->secure_ajax("input_name")
```

##### password_check()
This method is used to validate password. It checks password for the below conditions.

1. Min Length: 10
2. Max: Length: 32
3. Must contain atleast one capital letter, one small letter, one digit and one special character.

```php
if($request->password_check($password)) {
// Password is valid
} else {
// Not valid
}
```

##### hash()
This method is used to hash the strings like password.

```php
$hashed_password = $request->hash($password);
```

##### verify_hash()
This method is used to verify hashed string with normal string.

```php
if($request->verify_hash($string, $hashed_string))
{
// hash verified
}
else {
// hash not verified
}
```

##### all()
This method is used to get all the data from request by passing request name.

```php
$get_data = $request->all("get") // Returns all data from get method.
$post_data = $request->all("post") // Returns all data from post method.
$ajax_data = $request->all("ajax") // Returns all data from ajax request.
```

### Validation

Validation facade is used to validate form data. You can use the facade from controller as.

```php
use Facades\Validation;
```

```php
$request = new Request();
$email = $request->secure_input("email");
$password = $request->secure_input("password");

// Create validation instance
$validation = new Validation();

// Check email required.
$validation->name("email")->value($email)->required();

// Check password required
$validation->name("password")->value($password)->required();

// Check validation result
if($validation->isSuccess()) {
// Validation is success
}
else{
// Validation fails
return $this->back();
}
```

YNOTPHP has been adopted validation plugin from
[davidecesarano/Validation](https://github.com/davidecesarano/Validation) library. It provides flexible features and
developer friendly functionality. Check out the complete documentation in the official repository of library.

### Crypt

Crypt facade is used to encrypt and decrypt the string. Generally it will use your unique **APP_KEY** for encryption and
decryption.

YNOTPHP has been adopted [defuse/php-encryption](https://github.com/defuse/php-encryption) library for better security.

We can use this facade in our controller as follows.

```php
use Facades\Crypt;
```

Once included we can start to encrypt and decrypt strings.

```php
public function encrypt() {
$string = "YNOTPHP";

// Encrypt string
$encrypted_string = Crypt::encrypt($string);

// Decrypt string
$decrypted_string = Crypt::decrypt($encrypted_string);
}
```

### File

File facade is used to store files in server. It will collect the files from POST request and will be used to upload to
server.

```php
use Facades\File;
```

Once the facade is included, then we are free to use this facade inside our controller.

```php
public function addimage()
{
// Create file instance
$file = new File();

// Get file by input name
$image = $file->get("image");

// Create a new name for the uploaded file.
// If you don't give any new name it will upload using its current name.
$name = "gallery_".time();

// Upload file
// $file->upload(file, path, new_name)
// If file has been uploaded, then it will return its name.
$name = $file->upload($image, "images", $name);
if($name)
{
// Uploaded successfully
}
else {
// Not uploaded
}
}
```

YNOTPHP will upload files into **public/storage** directory.

Using this facade we can validate image sizes too using **validateImageSizes** method.

```php
public function image() {
$file = new File();
$image = $file->get("image");

// $file->validateImageSizes(image, width(px), height(px))
if($file->validateImageSizes($image, 100, 250)) {
// Validation passed
} else {
// Validation fails
}
}
```

### DB

DB facade will be used to explore database connection. It will be used in Models to connect with database.

```php
namespace Models;

use Facades\DB;

class Tag
{
public $table = "tags";

public function create($page, $tag)
{
// Open connection
$db = DB::open();

// Write query
$sql = "INSERT INTO tags (page, tag) VALUES (?, ?)";

// Execute query
$query = $db->stmt_init();
$query = $db->prepare($sql);
if($query)
{
$query->bind_param('is', $page, $tag);
$query->execute();

// Close connection
$query->close();
return true;
}
return false;
}
}
```

DB facade use **mysqli** class to open database connection. But developers are free to use any kind of connection they
want in the models without using the facade.

# Helpers

Helpers are functions which are developed to reduce the time of the coding of complex functionality.

Here are the helpers listed below:

### Configuration

##### env()

This function is used to get the variables from **env.php**.

```php
$keyAscii = env('APP_KEY');
```

##### db()

This function is used to get the variables from **db.php** in the current mode configured in **env.php**.

```php
$dbhost = db("DB_HOST");
$dbuser = db("DB_USER");
$dbpassword = db("DB_PASSWORD");
$dbname = db("DB_NAME");
```

This will return the values from **db.php** in the current mode in config directory.

If your mode is **testing** then it will return the values from **config/testing/db.php**.

##### email()

This function is used to get the variables from **mail.php** in your current mode.

```php
$mail->Host = email("MAIL_HOST");
$mail->Username = email("MAIL_USERNAME");
$mail->Password = email("MAIL_PASSWORD");
$mail->SMTPSecure = email("MAIL_ENCRYPTION");
$mail->Port = email("MAIL_PORT");
```

##### modeenv()

This function is uded to retrieve the variables from **env.php** from the current mode.

You can use this if you want any variables to be different in multiple modes.

```php
$variable = modeenv('VARIABLE_NAME);
```

### Path & Asset

##### asset()

This function is used to link scripts and stylesheets to the views. This function will point inside **public**
directory.

```html
<link rel="stylesheet" href="<?php echo asset('css/custom.css'); ?>" type="text/css" />
```

##### request_path()

This function is used to get the exact URL path of the web page.

```html
<li>
    <a href="<?php echo url('showcase')?>"
        class="home <?php if(request_path() == "showcase") echo "active"; ?>">Showcase</a>
</li>
<li>
    <a href="<?php echo url('about')?>" class="home <?php if(request_path() == "about") echo "active"; ?>">About Us</a>
</li>
```

##### request_is()

This function matches the prefix of the given path with the URL paths and returns **true** if matched.

```html
<li class="nav-item <?php if(request_is("masterzone/pages")) echo "active"; ?>"></li>
```

This will check if the url path contains **masterzone/pages** as prefix, if it is, then returns true.

##### url()

This function is used to generate URL.

```php
echo url("contact");
```

This will generate the complete url with contact. This will be used in both views and controllers.

##### get_url()

This function is used to get the current URL of the page. This will print entire URL.

```php
$url = get_url();
```

### Storage

##### storage_asset()

This function is used to retrieve the uploaded files from **storage** directory inside **public** directory.

```php
<img src="<?php echo storage_asset('images/uploaded.png'); ?>" /> 
```

This will return **public/storage/images/uploaded.png**.
