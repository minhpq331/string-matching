# Text Matching Implemention

This project is a demo about implementation of different text matching algorithm in PHP.

In this demo, only 2 text-matching algorithms are implemented: Naive algorithm and Knuth-Morris-Pratt algorithm. You can add your own algorithm just by extending `BaseTextMatchingAlgorithm` class, override `searchUseAlgorithm` method. After that, you can add your object initialization to `AlgorithmFactory` class. 

## Project Structure

    ci_cd/                  contains scripts to initialize project environment and auto deploy process
    server_config/          contains example web server configs
    server_log/             contains web server log
    src/                    contains project source code
        commands/           contains console commands (controllers)
        components/         contains project components such as helpers, assets, widgets, etc...
        config/             contains application configurations
        controllers/        contains Web controller classes
        models/             contains model classes, including form classes
        runtime/            contains files generated during runtime
        tests/              contains various tests for the basic application
        vendor/             contains dependent 3rd-party packages
        views/              contains view files for the Web application
        web/                contains the entry script and Web resources

### Prerequisites

System Requirements

```
- PHP 5.6.x + CLI with common ext and `curl`, `PCRE support`
- Composer

```

Note: `pcre.jit` in php.ini must be set to `0` 

### Installing

First extract this project to a folder (eg: `text-matching`), then run:

```bash
$ composer global require "fxp/composer-asset-plugin:~1.3" 
$ cd text-matching
$ bash ci_cd/initial_setup.sh
```

### Running

To run using built-in php server (http://localhost:8080), enter below commands:

```bash
$ cd text-matching/src
$ php yii serve
```

To run under your web server, please read Virtual host configure section below.

### Testing

To test this project simply run below commands

```bash
$ cd text-matching/src
$ vendor/bin/codecept run
```


### Virtual host configure

Point your domain to `src/web` folder

```
text.matching   ~>  .../src/web/

```

Demo virtual host configures can be found in folder `server_config`

Make below directories writable by `deploy` user, `php-fpm` user and `nginx` user: (usernames can change on deploy server)

```
.../src/web/assets
.../src/runtime
```

## Maintainers

**1. Pham Quang Minh**
    
- Role: Backend dev + System config
- Email: [minhpq331@gmail.com](minhpq331@gmail.com)

