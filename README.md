# Tidio interview app - Salary Report

### Build with
- [PHP 8.1](https://www.php.net/releases/8.1/en.php)
- [Symfony 6.1](https://symfony.com/releases/6.1)

<!-- GETTING STARTED -->

## Getting Started

To get a local copy of development environment up and running you need to fullfill prerequisites and follow installation steps. 

When building the application, sample test data included in the content of the recruitment task was imported into the database.

### Prerequisites

Install Docker Engine and Docker Compose with versions given below or newer (important!)

#### Docker Engine

```bash
dev@dev:$ docker -v
Docker Docker version 20.10.12, build e91ed57
```

#### Docker Compose

```bash
dev@dev:$ docker-compose -v
docker-compose version 1.29.2, build 5becea4c
```

### Installation

Follow these simple steps

#### Clone API repository

```bash
dev@dev:$ git clone git@github.com:KasiaDzimira/tidio-interview-api.git
```

#### Run below command to build fresh images

```bash
dev@dev:$ docker compose build --pull --no-cache
```

#### Run below command to run containers 

###### in detached mode -> Run containers in the background
```bash
dev@dev:$ docker compose up -d
```

###### without detached mode -> the logs will be displayed in the current shell
```bash
dev@dev:$ docker compose up
```

#### Done! Your application can be found at the following address

Open [https://localhost/](https://localhost/) in your browser and accept
SSL certificate.

#### Swagger API documentation
[https://localhost/api/doc](https://localhost/api/doc)

#### Run phpunit tests
###### enter the PHP container
```bash
dev@dev:$ docker exec -it tidio-interview-api_php_1 sh
```
###### run tests
```bash
dev@dev:$ ./vendor/bin/phpunit tests/
```