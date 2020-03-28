FROM debian:latest

EXPOSE 80
EXPOSE 8080
EXPOSE 443

#n/a
RUN groupadd badmin
RUN useradd -ms /bin/bash badmin -g badmin

#install-buster.sh
RUN apt-get update
RUN apt-get upgrade
RUN apt-get install apache2 -y
RUN apt-get install mariadb-client mariadb-server
RUN apt-get install php7.3 php7.3-mysql
RUN apt-get install python-mysqldb

#post-install.sh
RUN rm -R /var/www/html
ADD www /var/www
RUN chown badmin:badmin /var/www/html -R
RUN chmod 777 /var/www/html/species /var/www/html/pycode /var/www/html/images

#dbinstall.sh
RUN mysql </var/www/html/database/digitalfish.sql
RUN mysql <sql.sql



COPY  install/*.service /etc/systemd/system
RUN systemctl enable relaymanual
RUN systemctl enable customrelay
RUN systemctl enable thermcheck
RUN systemctl enable schedulecheck
RUN systemctl enable wavea
RUN systemctl enable waveb
RUN systemctl enable ato
RUN systemctl enable dose
RUN systemctl enable ldd
RUN systemctl enable dht

CMD tail -f /dev/null