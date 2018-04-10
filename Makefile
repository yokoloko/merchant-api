up:
	docker-compose up -d --remove-orphans
	(cd api && make database && make fixtures)
