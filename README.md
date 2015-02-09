TuumPHP/demo
============

a demo and development project for TuumPHP.

### License

MIT License

Installation
------------

get project from gitHub, and use composer to get the dependent packages.  

```
git clone https://github.com/TuumPHP/demo.git
cd demo
composer install
```

make ```var/``` directory writable to the web server,

```
chmod a+w var/
```

and start php.

```
cd public
php -S localhost:8080 index.php
```

