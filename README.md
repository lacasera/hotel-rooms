#### Trivago Case Study Solution

#### Assumption
In the real world, pooling rooms from advertisers would be done by a background job.
For a faster feedback loop for testing purposes, I created a command that will do this and save the data pooled.

Run testcases with `composer test`

#### Setup Instructions
After extracting the project, run the following commands to get started
1. run `docker-compose up --build -d` to build docker images
2. run `docker-compose exec trivago_api php artisan migrate` to run database migrations
3. run `docker-compose exec trivago_api php artisan advertisers:pool` to pool advertisers for rooms
4. visit `http://localhost:9002/v1/rooms

#### Tools Used
1. Framework: [Lumen](https://lumen.laravel.com/).
2. Database: [Mysql](https://www.mysql.com/)
3. Api Documentation: [OpenApi aka Swagger](https://swagger.io/specification/)

#### Design Patterns and Principles
1. Repository Pattern
2. Factory Pattern
3. Solid Principles