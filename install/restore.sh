cd /digitalfish-backup/html
tar xvf digitalfish.tar -C /
chown pi:pi  -R /var/www/html
clear
echo
echo Enter your database password to restore your database.
echo
sudo mysql digitalfish </digitalfish-backup/digitalfish.sql
echo
echo Your website and your database has been restored to the previous backup.
echo

