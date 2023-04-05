# Scrabble Club Project

This is a Scrabble Club project that uses Laravel 9 and Vue3. The project is designed to manage members and games data, 
including database tables and relations between them. Each game contains two members with scores for each and game date.
In this example, the principle of separation of responsibility of modules was used, so that all project files are located
in a separate directory, which can be found along the path: "app/Packages/ScrabbleClub". The structure of this directory
follows the usual structure of a Laravel project.

The project is built on the basis of the
Laravel framework, which provides a set of tools for working with the database, as well as a set of tools for working with
the user interface. The project also uses the Vue3 framework, which provides a set of tools for working with the user interface.


## Requirements

Before you start, make sure you have the following installed:

- Docker
- Docker Compose
- PHP 8 or higher (if you want to use the functionality of the sail package)
- Composer
- Node.js 12.x or higher
- NPM or Yarn

## Installation

1. Clone this repository:
git clone https://github.com/your-github-username/scrabble-club.git
2. Change directory to the project folder:
cd scrabble-club
3. Install the required packages:
   composer install
   npm install
4. Copy the `.env.example` file to `.env`:
   cp .env.example .env
5. Generate a new application key:
   php artisan key:generate
6. Start the application:
   ./vendor/bin/sail up -d
7. Run the database migrations:
   ./vendor/bin/sail artisan migrate --seed


## Usage

To use the application, open your browser and go to `http://localhost:8092`. You should see the home page with a list of members and games.

You can create, edit, and delete members and games using the web interface. The application also provides APIs to manage the data. You can access the APIs by sending HTTP requests to the endpoints listed in the API documentation.

## Development

I recommend using the Docker functionality to deploy the project, then you can be sure of the appropriate environment
to avoid unexpected errors in the project.
To do this, enter the project directory and run the command:

docker-compose up -d

after the download, creation and launch of the docker container is completed, you can enter the docker container with 
this application and execute the following commands already inside it.
To do this, run the command:
 docker exec -ti provalido-provalido.test_app-1 bash


Or you can do the actions using the functionality of the sail package and PHP, Node and NPM installed in your system

To develop the application, you can use the following commands:

- Start the application:

./vendor/bin/sail up -d

- Stop the application:

./vendor/bin/sail down  -v


- Compile assets:

npm run dev

- Watch assets:

npm run watch

## Credits

This project was created by [Ruslan Komlykov](https://github.com/rumus-bin).

## License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT).


