This project use api-platform intensively and is mainly inspired by it's skeleton.

To use this project

`docker-compose up`

Api is available at `localhost:8080`

`sudo echo api 127.0.0.1 >> /etc/hosts`
Api behind a Varnish reply under 5 ms at `api:8081`

Mail interface is available at : `localhost:8025`. It's very convenient for testing and qa environment.

Start RabbitMq consumer with : `cd api && make consume-event`
