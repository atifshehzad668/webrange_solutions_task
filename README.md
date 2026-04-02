
Project Setup & Run Commands
1. Clone the Repository
git clone <repository-url>
cd <project-folder>
2. Install Dependencies

Install all PHP packages using Composer.

composer install
3. Create Environment File

Copy the example environment file.

cp .env.example .env
4. Generate Application Key

Laravel requires an application key for encryption.

php artisan key:generate
5. Configure Database

Open .env file and set your database credentials.

Example:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_database
DB_USERNAME=root
DB_PASSWORD=
6. Run Database Migrations

Create tables in the database.

php artisan migrate
7. Seed Product Data

Insert sample products into the database.

php artisan db:seed --class=ProductSeeder
8. Optional: Reset Database and Seed Again

This will drop all tables, recreate them, and run seeders.

php artisan migrate:fresh --seed
9. Start Laravel Development Server

Run the project locally.

php artisan serve

Project will run at:

http://127.0.0.1:8000
10. Useful Laravel Commands
Clear Config Cache
php artisan config:clear
Clear Application Cache
php artisan cache:clear
Clear Route Cache
php artisan route:clear
for testing documentation available
