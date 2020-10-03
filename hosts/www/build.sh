exit
docker stop webserver
docker volume prune -f
docker network prune -f
docker system prune -a -f

docker build -t webserver/node-web-app .
docker create --name webserver -p 49160:8080 -p 3000:3000 webserver/node-web-app 
docker start webserver
docker exec -it webserver /bin/bash

npm install --save-dev nodemon
npm install -g nodemon

docker build -t mongo/node-db-app .
docker create -d -p 27017:27017 -p 28017:28017--name mongo mongo/node-db-app mongod --rest --httpinterface
docker start mongo
docker exec -it mongo /bin/bash
