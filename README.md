This project use api-platform intensively and is mainly inspired by it's skeleton.

To start using this project `docker-compose up`

If you want to load the database ``cd api && make database && make fixtures`

The api is available at `localhost:8080`

`sudo echo api 127.0.0.1 >> /etc/hosts`
Api behind a Varnish reply under 5 ms at `api:8081`

Mail interface is available at : `localhost:8025`. It's very convenient for testing and qa environment.

Start RabbitMq consumer with : `cd api && make consume-event`

If you want the event to be consumed directly change the `app.queue.producer` to `class: App\Queue\Producer\SynchronousProducer`
