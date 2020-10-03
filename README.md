# digital_fish

exit


docker stop mongodb
docker stop webserver
docker volume prune -f
docker network prune -f
docker system prune -a -f
docker network create --subnet=10.10.10.0/24 db-network
docker run --name mongodb -d mongo:latest
docker build -t webserver/node-web-app .
docker create --name webserver -p 49160:8080 webserver/node-web-app 


docker run -it --network db-network --rm mongo mongo --host mongodb webserver
docker start webserver
docker exec -it webserver /bin/bash

