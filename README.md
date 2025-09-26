<p align="center"><a href="#" target="_blank"><img src="https://dashboard.webprez.com/static/27/img/logo.svg" width="400" alt="Webprez Logo"></a></p>

## Steps to setup the project 

- clone the project
- then move to the project folder using `cd` command on your terminal
- run `composer install`
- copy `.env.example` file to `.env` on the root folder
- Open your `.env` file and change the database name (`DB_DATABASE`) to whatever you have, username (`DB_USERNAME`) and password (`DB_PASSWORD`) field correspond to your configuration
- Then add the portfolio DB data to (`REMOTE_DB_HOST`, `REMOTE_DB_PORT`, `REMOTE_DB_DATABASE`, `REMOTE_DB_USERNAME` and `REMOTE_DB_PASSWORD`)
- Change the mail host (`MAIL_HOST`) to whatever you have, mail username (`MAIL_USERNAME`) and mail password (`MAIL_PASSWORD`) field correspond to your configuration
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Empty the mail data (`MAIL_HOST`), (`MAIL_USERNAME`) and (`MAIL_PASSWORD`)
#

## Steps to run project in server

- clone the project
- then move to the project folder using `cd` command on your terminal
- run `composer install`
- run `sudo php artisan migrate`
- run `sudo php artisan db:seed`
- run `sudo php artisan storage:link`
