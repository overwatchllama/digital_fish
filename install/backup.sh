mkdir /jayfish-backup
mkdir /jayfish-backup/html
clear
echo
echo Please enter your MySQL password to backup your database.
echo
sudo mysqldump jayfish >/jayfish-backup/jayfish.sql
sudo tar cvf /jayfish-backup/html/jayfish.tar /var/www/html
clear
echo Your Database Should Be Listed Here as jayfish.sql
echo
ls -lh /jayfish-backup/ | grep jayfish
echo
echo Your tar backup should be listed here as jayfish.tar
echo
ls -lh /jayfish-backup/html/ | grep jayfish
echo
echo
echo To restore simply run sudo sh restore.sh

