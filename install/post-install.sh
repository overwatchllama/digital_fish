clear
echo
echo This is install is designed for a CLEAN install for Raspian STRETCH
echo
echo INSTALLING WEBSITE in /var/www/html
echo
sudo rm -R /var/www/html
git clone https://bitbucket.org/michaeljvdh/j5.git /var/www/html
sudo chown badmin:badmin /var/www/html -R
sudo chmod 777 /var/www/html/species /var/www/html/pycode /var/www/html/images
echo INSTALLING DATABASE j5.sql
echo
echo
clear
echo PLEASE REBOOT !!!!! and then navigate back to your install folder 
echo and run sudo sh dbinstall
echo ...
echo Afterwhich you can test by navigating to http://x.x.x.x where x.x.x.x = your Raspbery Pi ip address or hostname.