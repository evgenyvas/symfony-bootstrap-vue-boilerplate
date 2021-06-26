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
bin/console doctrine:database:create
bin/console doctrine:migrations:diff
bin/console doctrine:migrations:migrate
composer install
npm install
npm run dev
```

Adjust menu
-----------

`nvim src/Menu/ToolbarMainMenuBuilder.php`
