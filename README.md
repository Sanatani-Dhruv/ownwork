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
1. php (version: 8.2 or greater).
2. composer (version: 2.9 or greater).

### Structure

```bash
ownwork
   ├── app
   │   ├── Controller # Your Controllers directory
   │   │   └── UserController.php
   │   ├── Helper
   │   │   ├── ConsoleHelper.php # Pretty Printing for Console
   │   │   ├── Controller.php # Default Controller Template
   │   │   ├── Environment.php # File Which Setups your Environment Settings
   │   │   ├── Model.php # Default Model Template
   │   │   ├── View.php # Default View Template
   │   │   └── Views # Helper Views Directory like Error Pages
   │   │       ├── general-notfound-error.php
   │   │       ├── styles
   │   │       │   └── index.css
   │   │       └── view-notfound-error.php
   │   ├── Model # Your Models directory
   │   │   └── UserModel.php
   │   ├── Router
   │   │   └── Route.php
   │   └── Viewer
   │       └── View.php
   ├── bundle
   │   ├── Bundler.php # This File Bundles your App
   │   ├── HelperFunction.php # Global Helper Functions are defined here
   │   └── Routes.php
   ├── composer.json
   ├── composer.lock
   ├── public # This Directory will be exposed to User Side, Static Assets should be placed in it
   │   ├── index.php # Entry Level Files, Starting Point of App
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
composer run dev --timeout=0
```

### License

Ownwork Project is licensed under MIT License
