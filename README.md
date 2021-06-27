Symfony bootstrap vue boilerplate
=================================

Symfony + bootstrap-vue

Features
--------

- login form
- bootstrap-vue integration
- menu generator
- bootswatch themes switcher

Install
-------

```
composer install
npm install
npm run dev
```

Configure database connection in file `.env` or create new file `.env.local`:

```
APP_ENV=dev
DB_DATABASE=app
DB_USERNAME=dbuser
DB_PASSWORD=dbpassword
```

Execute commands:

```
bin/console doctrine:database:create
bin/console doctrine:migrations:diff
bin/console doctrine:migrations:migrate
bin/console regenerate-app-secret
bin/console doctrine:fixtures:load
```

Login: admin

Password: admin

Adjust menu
-----------

`nvim src/Menu/ToolbarMainMenuBuilder.php`
