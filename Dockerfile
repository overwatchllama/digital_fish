FROM debian:latest

EXPOSE 80
EXPOSE 8080
EXPOSE 443


RUN apt-get update
RUN apt-get upgrade
RUN apt-get install apache2 -y
RUN apt-get install mariadb-client -y
RUN apt-get install mariadb-server -y
RUN apt-get install php7.0 -y
RUN apt-get install php7.0-mysql -y
RUN apt-get install python-mysqldb -y

RUN groupadd badmin
RUN useradd -ms /bin/bash badmin -g badmin

RUN rm -R /var/www/html
RUN chown badmin:badmin /var/www/html -R
RUN chmod 777 /var/www/html/species /var/www/html/pycode /var/www/html/images

USER badmin
RUN mysql </var/www/html/database/digitalfish.sql
RUN mysql <sql.sql

COPY  install/*.service /etc/systemd/system
RUN systemctl enable relaymanual
RUN systemctl enable thermcheck
RUN systemctl enable schedulecheck
RUN systemctl enable wavea
RUN systemctl enable waveb
RUN systemctl enable ato
RUN systemctl enable dose
RUN systemctl enable ldd