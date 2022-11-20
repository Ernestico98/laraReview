# LaraRe
Project for Module 3 (Modern Web Applications 1) of Master in Computer Science at [Harbour.Space](https://harbour.space/).

It's a webpage to get or create reviews for places. It's built using Laravel framework. 

## Description
A simple website that allows you to create reviews from places or check other people's reviews. You can also report spam reviews to admins and they can check and hide those reviews.

## About the Project
### Models
* User 
* Place 
* Review
* Tag
* Complaint
* PlaceTag (pivot table in Many-to-Many realtion beetwen Place and Tag models)

## Getting Started

### Dependencies
- [Laravel 9.x](https://laravel.com/docs/9.x/installation)
- PHP 8
- Docker
- [Composer](https://getcomposer.org/download/)

### Installing (Run locally on Linux)
* Clone Repository
    ```bash
    git clone https://github.com/Ernestico98/laraReview
    ```

* Go to project directory
    ```bash
    cd laraReview/
    ```

* Rename .env.example to .env

* Install dependecies
    ```bash
    composer install
    ```
* Run container
    ```bash
    ./vendor/bin/sail up -d
    ```

* Generate key
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```
* Run migrations and seed database
    ```bash
    ./vendor/bin/sail artisan migrate:fresh --seed
    ```

* Compile resources and start server
    ```bash
    npm install
    npm run dev
    ```

## Notes
Default admin user:
```
user: admin
password: password
```


## Authors

[@ernestico98](https://github.com/Ernestico98/)
