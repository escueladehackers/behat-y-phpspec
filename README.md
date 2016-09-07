# Testing tools

## Setup

Run the following command to setup the docker container to execute the tests.

```bash
$ make install
```

## Usage

Start the container, if it's not already running.

```bash
$ docker-compose run --rm --service-ports dev bash
```

Install all the dependencies, if they're not already installed.

```bash
$ composer install
```

Execute the tests

```bash
$ bin/behat
$ bin/phpspec run
$ bin/phpunit --testdox
$ bin/robo acceptance
```
