#!/bin/bash
export rundir="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

usage(){
echo "
Christopher.mllr@gmail.com 8/5/2019

usage : ${0} [arguments]
   or : ${0} [arguments] option

Arguments:
-c Clean/destroy all 
-b Build	
-h Show this message and exit"
}
clean(){
container="webserver"
echo "Cleaning up Docker."
echo "Stop webserver."
docker stop webserver
echo "Delete webserver."
docker rm webserver
echo "Delete unused images."
docker rmi webserver
echo "Delete unused volumes."
docker volume prune -f
echo "Delete unused networks."
docker network prune -f
docker system prune -a -f
}
buildimage(){
imagename=${1}
[ -z "`docker images | grep ${imagename}`" ] && docker build -t ${imagename} . || echo "${imagename} already exists."
}
createnetwork(){
SUBNET=${1}
NETNAME=${2}
echo "create Docker network ${NETNAME}"
[ -z "`docker network list | grep ${NETNAME}`" ] && docker network create --subnet=${SUBNET}/24 ${NETNAME}  || echo "Docker Network $NETNAME already exists."
}
buildwebserver(){
buildimage webserver
docker create --name webserver -h webserver -p 8081:8081 webserver 
docker start webserver > /dev/null 2>&1
else
echo "Docker Container ${nodename} exists, configuration assumed to be correct."
V_BUILD="NO"
fi
}
dockzer(){
docker stop webserver
docker system prune -a -f
export imagename=webserver
export nodename=webserver
export portum=1521
export internalip="10.10.10.11"
export netnam="priv"
export SUBNET=10.10.10.0
export NETNAME=priv
docker build -t ${imagename} .
docker create --privileged --name ${nodename} -h ${nodename} --shm-size=2048m --memory-swap=4096m --memory=3072m -p ${portnum}:1521 ${imagename} tail -f /dev/null
docker network create --subnet=${SUBNET}/24 ${NETNAME}
docker network connect --ip ${internalip} ${netnam} ${nodename}
docker start ${nodename} > /dev/null 2>&1
docker exec -it webserver /bin/bash

#docker build -t webserver .
#docker create --privileged --name ${nodename} -h webserver --shm-size=2048m --memory-swap=4096m --memory=3072m -p 1521:1521 webserver tail -f /dev/null
#docker network create --subnet=10.10.10.0/24 priv
#docker network connect --ip "10.10.10.11" priv webserver
#docker start webserver > /dev/null 2>&1
#docker exec -it webserver /bin/bash



}


while getopts "cb" opt; do
  case "${opt}" in
c)
echo "Cleanup all docker customizations"
clean
;;
b)
echo "Building"
createnetwork  10.10.10.0 priv
buildwebserver
;;
\?)
echo "Invalid option: -$OPTARG"
usage
;;
  esac
done

exit 0 