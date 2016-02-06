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



Tests about docbook can also validate generated docbook content against
the official Docbook 5 relaxng schema. If you want to activate validation tests,
install xmllint, docbook 5 relaxng, and create an environment variable
DOCBOOK_RNG containing "yes" or a path to the relaxng file.

On debian/ubuntu, you just have to install libxml2-utils and docbook5-xml
packages, and set DOCBOOK_RNG="yes".