# Getting started

## Installation
Clone the repository

    git clone https://github.com/Sadaev/newsParserLaravel.git

Switch to the repo folder

    cd newsParserLaravel

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    npm install

    npm run dev

    php artisan serve


## Database seeding

Run the database seeder and you're done

    php artisan db:seed

Run console command
    
    php artisan rss_parser:start

Run cron job every minutes

    php artisan schedule:run
    php artisan schedule:work //show running jobs
    php artisan schedule:list //show jobs



