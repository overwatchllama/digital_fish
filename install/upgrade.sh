clear
while true; do
read -p "Upgrading from a previous version will mean that you will lose data.
But it will not try to reinstall the database server or the webserver.
If you have written down your previous GPIO and or other configurations.
PLEASE NOTE YOU CANNOT RUN THIS FILE IF YOU ARE ALREADY ON J5.

Please proceed by answering (y/n)" yn
case $yn in
        [Yy]* )         sudo sh webupdate.sh;

                                systemctl stop waveb.service;
                                systemctl stop wavea.service;
                                systemctl stop thermcheck.service;
                                systemctl stop schedulecheck.service;
                                systemctl stop relaymanual.service;
                                systemctl stop feed.service;
                                systemctl stop dose.service;
                                systemctl stop ato.service;

                                systemctl disable waveb.service;
                                systemctl disable wavea.service;
                                systemctl disable thermcheck.service;
                                systemctl disable schedulecheck.service;
                                systemctl disable relaymanual.service;
                                systemctl disable feed.service;
                                systemctl disable dose.service;
                                systemctl disable ato.service;

                                rm /etc/systemd/system/waveb.service;
                                rm /etc/systemd/system/wavea.service;
                                rm /etc/systemd/system/thermcheck.service;
                                rm /etc/systemd/system/schedulecheck.service;
                                rm /etc/systemd/system/relaymanual.service;
                                rm /etc/systemd/system/feed.service;
                                rm /etc/systemd/system/dose.service;
                                rm /etc/systemd/system/ato.service;
                                echo
                                echo Creating Database
                                echo
                                sudo mysql </var/www/html/database/digitalfish.sql;
                                echo Installing Services
                                echo
                                sudo sh service-install.sh;
                                echo;
                                echo PLEASE REBOOT;
                                echo;

                                break;;
        [Nn]* ) exit;;
    esac
done

