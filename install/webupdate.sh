clear
mkdir species
cp /var/www/html/species/*.* species/
git clone https://bitbucket.org/michaeljvdh/j5.git digitalfish/www
rm -R /var/www/html/*
mv digitalfish/www/* /var/www/html
rm -R digitalfish
cp species/*.* /var/www/html/species/
rm -R species/
chown -R pi:pi /var/www/html/*
chmod 777 /var/www/html/species /var/www/html/pycode /var/www/html/images
echo
echo Installation Complete, test by navigating to http://x.x.x.x where x.x.x.x = your Raspbery Pi ip address or hostname.

