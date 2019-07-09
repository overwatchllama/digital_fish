clear
git clone https://bitbucket.org/michaeljvdh/digitalfish40.git digitalfish/www
rm -R /var/www/html/pycode/*
mv digitalfish/www/pycode/* /var/www/html/pycode
rm -R digitalfish
chown -R pi:pi /var/www/html/pycode/*
echo Python Scripts Updated, Please Reboot.