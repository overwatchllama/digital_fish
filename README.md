# digital_fish

docker volume prune -f
docker network prune -f
docker system prune -a -f

docker build -t webserver/node-web-app .
docker create --name webserver -p 49160:8080 webserver/node-web-app 
docker start webserver
docker exec -it webserver /bin/bash



#auth0 dev-it5l-39k.us.auth0.com
