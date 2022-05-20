# Laravel sl
## Objective
To provide web accessible administration interface for Second Life LSL Scripts

## Setup
To set up the project run
* composer install
* create .env in the root folder, and add your database information
* php artisan migrate
* npm install && npm run dev   

## Using Laravel-SL for your Backend LSL Scripts as a DataStore

The Laravel-SL project has a backend web interface which can be logged into, and used to 
administer data.

Laravel-SL has a Table called slobjects which will be used to store information from objects in secondlife useful to your scripts.

A Laravel-SL Server prim for example can used in world to connect with the Laravel-SL backend website.



Problem:
You need a backend database for your LSL Quiz save data in such as course, quiz, questions
For this you will need to first to create the table either in phpymadmin, mysql workbench, or phpstorm

Once your table is created, you will need a Laravel Eloquent model and api scafolding to manipulate the data using your lsl script inworld through [llHTTPRequest](https://wiki.secondlife.com/wiki/LlHTTPRequest)

So lets begin:

1) Create a table in mysql called quiz, add some fields
2) Create the API and Model scafolding 
```php artisan infyom:api_scaffold Quiz --fromTable --tableName quiz```
3) View the CRUD going to http://localhost/home
4) Register a new user, and login
5) create a quiz
6) now go to http://localhost/api/quizzes to view the data


## LSL Scripts
https://wiki.secondlife.com/wiki/LlHTTPRequest
