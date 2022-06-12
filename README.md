# Laravel-Meta-Connect

Laravel Meta Connect is an attempt to connect the Virtual World of Second Life with Laravel, so that we can programatically interchange data from a Web App to Second Life / Opensim.  This library of code should act as a starting point to augment in-world games with a web interface.

To get an idea of what is possible when connecting a web interface to Second Life games, checkout the very successful [live.gaming.sl](http://live.gaming.sl/) website.

## Objectives
To acheive this, Laravel-Meta-Connect will consist of serveral in-world LSL Scripts which, once configured, will communicate with Laravel to provide the following:

A Laravel View that displays Current Games Being Played In Second Life with Active players.
** A player will be registered as playing if they are sitting in a game chair (to be developed), or has clicked join on a Join Game Button (to be developed)

A Laravel view that displays a scoreboard that lists top scores of an in-world Meta-Connect game

A Laravel View that displays the latest Zombie Attacks that have happened in-world from the Zombie Attacks Quiz Game. Users will have to answer questions to defend against a zombie attacks. Note: I have already created this game in Second Life, Code is just needed to pull in quiz questions from Laravel, and to report all Zombie Attacks. A Laravel backend web interface will be used for creating a quiz and questions for each in-world zombie attacks game

Transporter Quiz: Sit in a Second Life vehicle, and have it move to next location by answering a question. Locations are saved in the database physically in world by moving to the location, and clicking a save-location button on a HUD in Second Life. User will also add a description to the location. A Laravel backend web interface will be used for attaching a question to each location saved.

Scavenger Hunt Game: Place Scavenger hunt objects around the Virtual World (each registering with Meta Connect), have users collect points by clicking each object placed. A Laravel view will display a SLURL (SL URL) to each item inside Second Life, that users will need to teleport to. The View will display a checkmark beside each item collected. Another Laravel View will list a Grid of each item, and of each user who has joined the game, and who has collected each item. Points will be awarded to each user when an item is collected. A Laravel backend web interface will be used for attaching a question to each location saved.

![image](https://user-images.githubusercontent.com/331626/173256589-a8f35e02-04e7-4a15-b862-998e8541d2eb.png)



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
