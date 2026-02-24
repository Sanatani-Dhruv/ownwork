# OwnWork - Minimal framework for an MVC Project
---

![Commits](https://flat.badgen.net/github/commits/Sanatani-Dhruv/ownwork)
![Last Commit](https://flat.badgen.net/github/last-commit/Sanatani-Dhruv/ownwork)
![Latest Release - Github](https://flat.badgen.net/github/release/Sanatani-Dhruv/ownwork)
![Packagist Name](https://flat.badgen.net/packagist/name/dhruv125/ownwork)
![Latest Release - Packagist](https://flat.badgen.net/packagist/v/dhruv125/ownwork)
![Language](https://flat.badgen.net/packagist/php/dhruv125/ownwork)
![Downloads](https://flat.badgen.net/packagist/dt/dhruv125/ownwork)
![Dependencies](https://flat.badgen.net/packagist/dependents/dhruv125/ownwork)
![License](https://flat.badgen.net/github/license/Sanatani-Dhruv/ownwork)

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

1. Make sure your composer version is atleast 2.9 or greater.

```bash
composer --version
```

2. Run the Composer Command to Create Project

```bash
composer create-project dhruv125/ownwork 

# Or
# composer create-project dhruv125/ownwork ProjectName
# This is will create project in ProjectName Directory
```

3. cd to Project Directory `ownwork` and Run `composer run setup` command.

```bash
cd ownwork/
composer run setup
```

4. Edit .env file.

```bash
APP_NAME=Ownwork

DB_NAME=mysql
DB_HOST='127.0.0.1'
DB_USER=root
DB_PASS=
```

> That's it, your OwnWork application is ready to run it's Hello World Program.

### Usage

1. Run The Server through `worker` script

```bash
php worker serve
```

- Supposed Output:
```bash
Starting OwnWork server at port:8000...
[Mon Jan 01 00:00:00 2026] PHP 8.2.XX Development Server (http://localhost:8000) started
```

> Or

Just Run Command

```bash
composer run dev
```

### Documentation

- Go through Documentation of OwnWork <a href="https://github.com/Sanatani-Dhruv/ownwork-doc" target="_blank">Here!</a>

### Recommended Packages

- Since our OwnWork is really minimal Framework, you may require other packages for functionality like Database interactions.
- Recommendations are:
   - `delight-im/db`: For database interaction - [Github Link](https://github.com/delight-im/PHP-DB)
   - `phpunit/phpunit`: For testing - [Github Link](https://github.com/sebastianbergmann/phpunit)
   - `illuminate/support`: For Illuminate Support like in Laravel

### License

Ownwork Project is licensed under MIT License
