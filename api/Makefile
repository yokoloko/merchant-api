consume-event:
	docker exec igraal_php bin/console rabbitmq:consumer event

composer-update:
	docker exec igraal_php composer update

database:
	docker exec -it igraal_php bin/console doctrine:database:drop --force
	docker exec -it igraal_php bin/console doctrine:database:create
	docker exec -it igraal_php bin/console doctrine:migrations:migrate -n

fixtures:
	docker exec -it igraal_php bin/console doctrine:fixtures:load -n

test:
	docker exec -it igraal_php php bin/phpunit
