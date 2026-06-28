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
- Amazing Blade like View templating Engine

### Dependencies
1. php (version: 8.0 or greater).
2. composer (version: 2.9 or greater).
> Optional Dependencies
3. nodejs (version: 20.0 or greater)
4. npm (version: compatible with nodejs)

### Structure

```bash
ownwork
   ├── app
   │   ├── Controller # Your Controllers directory
   │   │   └── UserController.php
   │   └── Model # Your Models directory
   │       └── UserModel.php
   ├── bundle # Files Which run when starting ownwork, like loading dotenv, etc
   │   ├── Bundler.php # This File Bundles your App
   │   ├── Helper.php # Global Helper Functions are defined here
   │   └── Routes.php # Your Routes are defined here
   ├── composer.json
   ├── composer.lock
   ├── node_modules
   ├── package-lock.json
   ├── package.json
   ├── public # This Directory will be exposed to User Side, Static Assets should be placed in it
   │   ├── .htaccess # Config file for Apache web server
   │   ├── build # Will contain build file of Tailwind CSS
   │   ├── index.php # Entry level file, starting point of App
   │   └── styles
   │       └── tailwind.default.css # Compiled CSS file for default page(don't delete this file)
   ├── resources
   │   ├── appviews # Views required by OwnWork like error pages
   │   │   ├── error_layout.php
   │   │   ├── no-info-error.php
   │   │   ├── script
   │   │   │   └── script.js
   │   │   ├── stackTrace-block.php
   │   │   └── styles
   │   │       └── index.css
   │   ├── css
   │   │   └── tailwind.css # Default tailwind source file
   │   ├── template # Default Templates for Component's like controller, view, model
   │   │   ├── Controller.php # Default Controller template
   │   │   ├── Model.php # Default Model template
   │   │   └── View.php # Default View template
   │   ├── views # Your Views directory
   │   └── views.json # Contains mapping of template files to their compiled form
   ├── vendor # Application dependecies and autoloader directory
   │   └── autoload.php # Include this to autoload files
   └── worker # Your Command Line Manager
```

### Installation

1. Make sure your composer version is atleast 2.9 or greater.
> npm installation is appreciated for ease of workflow

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

1. Run The Server through `worker` script or `composer` run-script

```bash
composer run dev
# or 
# php worker serve
```

- Supposed Output:
```bash
Starting OwnWork server at port:8000...
[Mon Jan 01 00:00:00 2026] PHP 8.2.XX Development Server (http://localhost:8000) started
```

- Run the view template transpiler in another terminal

```bash
php worker transpile
# or
# composer run transpile
```

> if You have npm installed, all this process can be avoided

- Run below command to install dependencies:

```bash
npm i
```

- After Successful installation message, whenever you want to run server + transpiler + tailwind dev server, run the command:

```bash
npm run dev
```

### Documentation

> Documentation is incomplete
- Go through Documentation of OwnWork <a href="https://github.com/Sanatani-Dhruv/ownwork-doc" target="_blank">Here!</a>

### Recommended Packages

- Since our OwnWork is really minimal Framework, you may require other packages for functionality like Database interactions.
- Recommendations are:
   - `delight-im/db`: For database interaction - [Github Link](https://github.com/delight-im/PHP-DB)
   - `phpunit/phpunit`: For testing - [Github Link](https://github.com/sebastianbergmann/phpunit)

### License

Ownwork Project is licensed under MIT License
