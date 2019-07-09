


# If you would like to use this as a cron job, make sure that you un hash the folloiwng lines and edit appropriately.
# the following line simply changes to where every you created your j5 install folder, and then executes from there, this is necesary
# because it needs to know where the .sql files are.  If it does not run from the j5 intall folder it will fail.  You will also notice
# that it will  not impact your current digitalfish backup usage.  SO I suggest you run the normal digitalfish Backup before you proceed.
# if you have problems you can use the jaydish resetore script to revert and try again and so on.
# the line below ... replace [your digitalfish install folder] with your path and NO brackets.  Save ... and include in your cron.
# NOTE: you can run this mnanually if you prefer, just just doing a sudo sh ibdata1flush.sh in the install folder.


# cd /[your digitalfish install foldler]
mkdir /digitalfish-backup
mkdir /digitalfish-backup/ibdata

clear
echo Working !!! Please Wait ...
echo Stopping Services
sudo sh servicestop.sh
sudo rm /digitalfish-backup/ibdata/*
echo Backing Up DB
sudo mysqldump digitalfish >/digitalfish-backup/ibdata/digitalfish.sql
echo Dropping DB and clearing SQL
sudo mysql <ibdata1flush.sql
echo Stopping SQL
sudo service mysql stop

echo
echo Current ibdata size below ...
echo

ls -lh  /var/lib/mysql | grep ib
sudo rm /var/lib/mysql/ib*
echo Rebuilding ibdata1
sudo service mysql start

echo
echo Setting up DB.
echo
sudo mysql <ibdata1flush2.sql
echo
echo Restoring DB
sudo mysql digitalfish </digitalfish-backup/ibdata/digitalfish.sql

echo
echo Cleaned up ibdata size below ...
echo

ls -lh  /var/lib/mysql | grep ib

echo
echo Your database has been restored to the previous backup, and ibdata1 has been flushed.
echo
echo It should be good to go.
echo
echo System is about to Reboot ! 10 seconds - Press CTRL - C if you want to stop it now !!
sleep 10
sudo reboot
