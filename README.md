# Laravel-Meta-Connect

Laravel Meta Connect is an attempt to connect the Virtual World of Second Life with Laravel, so that we can programatically interchange data from a Web App to Second Life / Opensim.  This library of code should act as a starting point to augment in-world games with a web interface.

To get an idea of what is possible when connecting a web interface to Second Life games, checkout the very successful [live.gaming.sl](http://live.gaming.sl/) website.

## Objectives
* To create a library of code for any larvel project to connect to virtual world objects in Second Life or Opensim
* Build an Inworld Beacon Script that updates Laravel-Meta-Connect with Current Games being Played, and provide associated location link
* Build an Inworld Scoreboard, and a Website Widget to keep track of Top scores for Scripted Second Life / Open Sim Games
* Build a Quiz Module where educators can submit questions and quizzes on line, and be able to connect them with a variety of in world quiz games including:
* Provide Badges and achievement Module
* Zombie Quiz Game: Answer question to defend against a zombie attack
* Transpoter Quiz: Sit in a vehicle, and move to next location by answering a question
* Scavenger Hunt Game:  Place Scavenger hunt objects around the Virtual World, have users collect points by clicking each object placed


### Setup
1) Clone the project
   1) git clone git@github.com:firecentaur/laravel-meta-connect.git
2) Change to the folder 
   1) cd laravel-meta-connect
3) Install dependencies 
   1) composer install 
4) Create config file
   1) cp .env.example .env
   2) update database information in .env 
5) Create a hosting account on heroku 
6) [download](https://devcenter.heroku.com/articles/heroku-cli) the heroku client to your os 
7) login to heroku on your console
   1) heroku login -i 
8) heroku git:remote -a <app-name>
9) git push heroku HEAD:master 
10) php artisan key:generate --show 
11) heroku config:set APP_KEY=<the_key>
12) follow https://devcenter.heroku.com/articles/getting-started-with-laravel
13) edit .env.heroku and put heroku and db info in it 
14) run python script to copy your .env.heroku variables to heroku
    1) python3 heroku-env.py
    2) 5) Run database migrations
15) php artisan migrate
16) Install frontend dependencies
     1) npm install && npm run dev


# Heroku Database setup
1)  heroku addons:create cleardb:free --name=laravel-sldb 


## Using Laravel-meta-connect for your Backend LSL Scripts as a DataStore

https://wiki.secondlife.com/wiki/LlHTTPRequest
