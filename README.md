# Test project
This is a test project made in frames of the coding challenge. Project is based on Symfony5 and PHP8

## Abstract
This is an API service, which is a part of a marketplace platform product, where users can find human advisors

## Scope and tech stack
Scope of this implementation is limited due to tough deadlines:
- Proper image upload, resize and handling is not implemented
- Readiness to production such as proper monitoring and appropriate logging, is missing
- Listings and filtering are implemented with built-in using ready framework API Platform, according to the Symfony documentation. Custom controller implemented only for create operation.
- Validation of the input data is implemented with Symfony default validators, including, for example, validation of languages or validation of price amount not to be negative
- Currency entry and validator is still missing and should be added on later point of time

The following tech stack is used:
- PHP 8.02
- Symfony 5 framework
- Doctrine ORM
- API Platform (https://api-platform.com)
- MariaDB MySQL compatible database
- Docker, Docker Compose, Docker Hub
- Composer

## Installation
To run the project locally, it's enough to have Docker Desktop running 
and use provided Makefile with the following command:

```shell
make start
```

This will build needed PHP8 image and application, pull the MariaDB instance and launch everything within Docker Compose 

After this, project will be available locally on http://localhost:8000/api

There are more Makefile commands available:

```shell
make test
make build
make down
```

The last command can be used to shutdown the test application locally after demo is finished

## Usage example
After installation and start of the project, api UI is available on http://localhost:8000/api
First, Advisor entries can be added with POST command with following example body:
```
{
  "name": "Test name",
  "description": "Test description",
  "availability": true,
  "pricePerMinute": 5,
  "languages": [
    "de",
    "en"
  ],
  "image": null
}
```
After this, all other operations can be used to retrieve list of saved entries, delete or update specific entry.
