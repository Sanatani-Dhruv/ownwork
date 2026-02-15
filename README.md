# OwnWork - Minimal framework for an MVC Project
---

![Commits](https://flat.badgen.net/github/commits/Sanatani-Dhruv/ownwork)
![Last Commit](https://flat.badgen.net/github/last-commit/Sanatani-Dhruv/ownwork)

- Don't go into major dependencies rabbit hole.
- Build your MVC app with PHP.
- Simple Routing.
- Easier View Creation.
- Build a Large Web App with minimal but useful base.

### Dependencies
1. php (version: 8.0 or greater).
2. composer (version: 2.9 or greater).

### Structure

```bash
ownwork
   ├── app
   │   ├── Controller # Your Controllers directory
   │   │   └── UserController.php
   │   ├── Helper
   │   │   ├── AppViews # Views Required by OwnWork like Error Pages
   │   │   │   ├── general-notfound-error.php
   │   │   │   ├── styles
   │   │   │   │   └── index.css
   │   │   │   └── view-notfound-error.php
   │   │   ├── ConsoleHelper.php # Pretty Printing for Console
   │   │   ├── Environment.php # File Which Setups your Environment Settings
   │   │   └── Template
   │   │       ├── Controller.php # Default Controller Template
   │   │       ├── Model.php # Default Model Template
   │   │       └── View.php # Default View Template
   │   ├── Model # Your Models directory
   │   │   └── UserModel.php
   │   ├── Router
   │   │   └── Route.php # This File handles Routing, should not be modified, unless you know what you do.
   │   └── Viewer
   │       └── View.php # This File handles calling views, should not be modified, unless you know what you do.
   ├── bundle
   │   ├── Bundler.php # This File Bundles your App
   │   ├── HelperFunction.php # Global Helper Functions are defined here
   │   └── Routes.php # Your Routes are defined here
   ├── composer.json
   ├── composer.lock
   ├── public # This Directory will be exposed to User Side, Static Assets should be placed in it
   │   ├── index.php # Entry Level File, Starting Point of App
   │   └── styles
   │       └── index.css
   ├── resources
   │   └── views # Your Views directory
   │       ├── main.php
   │       └── welcome.php
   ├── vendor # Application Dependecies and autoloader directory
   └── worker # Your Command Line Manager
```

### Installation

1. Clone this repo.

```bash
git clone https://github.com/Sanatani-Dhruv/ownwork.git
```

2. cd to `ownwork` directory and Run `composer setup` command.
```bash
cd ownwork/
composer run setup
```

3. Edit .env file.
```bash
APP_NAME=Ownwork

DB_NAME=mysql
DB_HOST='127.0.0.1'
DB_USER=root
DB_PASS=
```

> That's it, your Ownwork application is ready to run it's Hello World Program.

### Usage

1. Go to `/public` folder.

```bash
cd public/
```

2. Run PHP's development server in that directory.

```bash
php -S localhost:8000
```

3. Now open your preferred Browser and go to URL `http://localhost:8000/`.

> Or

Just Run Command

```bash
composer run dev
```

### Documentation

#### Routing

- Your Application Routings are defined in `bundle/Routes.php`.
- There Are Some Default Route Set, they look like:

```php

<?php

namespace Bundle;

use App\Router\Route;
use App\Controller\UserController;

$route = new Route();

$route->get("/", "main.php");

$route->post("/game/{name}/game", [
   UserController::class, "showDetail", [
      "name" => "Hi",
      "id" => 11
   ]
]);

$route->end();
```

##### Let's Understand This:

> The class `App\Router\Route` is Your Main Router Class, placed at `app/Router/Route.php`.

1. `Router::get(string $request_uri, $viewName_methodCall)`

- It defines HTTP GET Requests for your App.
- It's Arguments:
   - `$request_uri` : Incoming Url request from client ex. `/welcome`
   - `$viewName_methodCall` : It can accept two type of argument:
      - string: It will be treated as View name. We will Learn about Views later.
      n array: It will be treated as Method call
         - 0th element would be Full class name (type: string)
         - 1st element would be method name(type: string)
         - 2nd element would be array of arguments going to be passed into method (type: depends on your defined method).

- Example:
```php
$route->get('/welcome', 'welcome.php');

// Or

$route->get('/hello', [
    UserController::class, 'ShowHelloWorld', [
        'foo', 'bar'
    ]
]);
```


### License

Ownwork Project is licensed under MIT License
