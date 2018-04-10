up:
	docker-compose up -d --remove-orphans
	(cd api && make composer-install && make database && make fixtures)
