# Bugloos Backend Coding Challenge

This application is designed to perform two primary tasks:

1- Creating a console command that parses the [log file](logs.txt) and inserts the data into the database.

2- Designing a REST API endpoint which returns a count of rows that match the filter criteria. This endpoint accepts filters via GET HTTP verb and allows zero or more filter parameters.

## Installation

To create a project from this repository:

```bash
  git clone https://github.com/mehrdad-moslemi/Bugloos.git
  cd Bugloos
  composer install
  cp .env.example .env
  php artisan key:generate
```

## Environment Variables

To run this project, you will need to connect application to database by changing the following environment variables in your .env file:

`DB_DATABASE`

`DB_USERNAME`

`DB_PASSWORD`

Then run migration command:

``` bash
php artisan migrate
```

And then launch the server:

``` bash
php artisan serve
```

The Laravel Bugloos project is now up and running, Access it at http://localhost:8000.

## Running Tests

The implemented test is Model/Database assertion test to check existence of tables and inserting data with use of laravel factories.

PHP Trait called 'ModelHelperTesting' in 'Tests\Feature\Models' can be used inside any test class to prevent any duplication. LogTest.php will test the existence of logs table and inserts data based on fillables defined in Log model.

To run tests, run the following command:

```bash
  php artisan test
```

## Parsing the log file

The primary purpose of this command is to parse the input file, splitting it into separate parts and storing it in database line by line via the Log model.

PHP class called 'StoreLogToDB' with this namespace : 'App\Console\Commands', is responsible for this artisan command.

To perform, run the following command:

```bash
  php artisan log:store-file
```

It will ask you to enter the relative path of the log.txt file from your computer or drag it into the terminal. Then the handle method will check the existence of this file; if the file does not exist, the console will show a proper error and exit, Otherwise the handle method will use the line method in the File facade to review the log file line by line. With the php preg_split function, the line will be split into seven separate parts, so now there is complete control over each piece to correctly store in the database.

## API Reference

Implementing filters: 
 - Defining scopeFilter in the Log model to create a new object from the PHP class called 'FilterBuilder.php'.
 - 'FilterBuilder.php' with accepting three arguments, will determine to use which filter class is defined in the LogFilters folder based on URI input.
 - Therefore, whenever it is necessary to add a new filter, we need to create a new class inside the LogFilters folder with the name of the desired filter.
 - Inside the handle method of each filter class, the query will check the intended database column or even relation and return matching results.

```bash
  GET /api/logs/count?serviceNames[*]=serviceName&statusCode[*]=statusCode&startDate=startDate&endDate=endDate
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `serviceName` | `string` | **Optional**. filter records by name of the service |
| `statusCode` | `integer` | **Optional**. filter records by status code |
| `startDate` | `DateTime` | **Optional**. get the records with greater or equal datetime |
| `endDate` | `DateTime` | **Optional**. get the records with less or equal datetime |

Note that as it is possible to input more than one serviceName or statusCode, the filter will accept these conditions:

String form:

```bash
  GET /api/logs/count?serviceNames=serviceName&statusCode=statusCode
```
Or Array form:

```bash
  GET /api/logs/count?serviceNames[0]=serviceName1&serviceNames[1]=serviceName2
```

## Roadmap

- Implementing tests for console command like:
  - Test importing with specified file or input
  - Test importing without file or input
  - Test canceling import logs command

- In console command:
  - Preventing duplication in importing log files by comparing database records.
  - Showing error if data is duplicate.
  - Implement input file validation.
  - Registering users and allowing desired users with their password to perform command, Note that there is an implementable option in artisan commands to hide user's typing like passwords.
  - Asking for confirmation of task, with or without the default value.
  - Showing progress bar while application is taking care of task.
  - As it is possible to call this command anywhere in the application using Artisan Facade, it can be effective to use form request with file input on the desired route to perform this command.
  
- Implementing more filters on API endpoint like: 
  - method(http verb)
  - path
  - protocol