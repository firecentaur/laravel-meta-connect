# Laravel sl
## Objective

### Setup
1) Clone the project
   1) git clone git@github.com:firecentaur/laravel-sl.git
2) Change to the folder 
   1) cd laravel-sl
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


## Using Laravel-SL for your Backend LSL Scripts as a DataStore

https://wiki.secondlife.com/wiki/LlHTTPRequest
