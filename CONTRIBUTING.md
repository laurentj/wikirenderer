How to contribute
=================

First install [Composer](http://getcomposer.org). Then you can generate the autoload file
and install phpunit with this command line:

```
composer install
```

When you do modifications in the source code, be sure that all tests pass:

```
cd tests
../vendor/bin/phpunit
```

