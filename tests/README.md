Launching unit tests
====================

Before the first launch of tests, you need to build the docker image that run tests, and install the dependencies (PHPunit etc).

So launch:

```bash
./launch-tests.sh build
./launch-tests.sh composer-install
```

To launch tests, just type `./launch-tests.sh tests`.

You can add PHPUnit parameters to the command line, for example `./launch-tests.sh tests --coverage-html coverage`.
