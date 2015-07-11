Pages
=====

ZF2 Module for easily creating content pages and blocks

Introduction
------------


Requirements
------------
* [Zend Console](https://github.com/zendframework/zend-console) (~2.5.0)
* [Zend DB](https://github.com/zendframework/zend-db) (~2.5.0)
* [Zend ModuleManager](https://github.com/zendframework/zend-modulemanager) (~2.5.0)
* [Zend MVC](https://github.com/zendframework/zend-mvc) (~2.5.0)
* [Zend ServiceManager](https://github.com/zendframework/zend-servicemanager) (~2.5.0)

Features / Goals
----------------
* Create DB table with init console command [DONE]
* Create page with WYSIWYG editor in admin [IN PROGRESS]
* Get page by ID [IN PROGRESS]
* Show page by route [IN PROGRESS]
* List pages in admin (backend) zone [IN PROGRESS]
* Edit page in admin (backend) zone [IN PROGRESS]
* Remove page in admin (backend) zone [IN PROGRESS]

Installation
------------


Usage
------------


Testing
------------
For running tests you need install and intialize codeception, after this create/update codeception.yml in you project root and add Pages tests, like this:
```yml
include:
    - vendor/t4web/pages  # <- add modules tests to include

paths:
    log: tests/_output

settings:
    colors: true
    memory_limit: 1024M
```
After this you may run functional tests from your project root
```bash
$ codeception run
```
