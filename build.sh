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
}
createnode(){
nodename=${1}
portnum=${2}
internalip=${3}
netnam=${4}
if [ -z "`docker ps -a | grep ${nodename}`" ]; then
echo "defining ${nodename}"
docker create \
--privileged \
--name ${nodename} \
-h ${nodename} \
--shm-size=2048m \
--memory-swap=4096m \
--memory=3072m \
-p ${portnum}:1521 \
webserver \
tail -f /dev/null
if [ -z "${internalip}" ]; then
echo "no IP assitned."
else
docker network connect --ip ${internalip} ${netnam} ${nodename}
fi 	
echo "starting ${nodename}"
sleep 10
docker start ${nodename} > /dev/null 2>&1
else
echo "Docker Container ${nodename} exists, configuration assumed to be correct."
V_BUILD="NO"
fi
}

while getopts "cb" opt; do
  case "${opt}" in
c)
echo "Cleanup all docker customizations"
clean
;;
b)
echo "Building"
buildwebserver
createnetwork  10.10.10.0 priv
createnode webserver 1521 10.10.10.11 priv
;;
\?)
echo "Invalid option: -$OPTARG"
usage
;;
  esac
done

exit 0 