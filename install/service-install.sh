cp  *.service /etc/systemd/system
sudo systemctl enable relaymanual
sudo systemctl enable thermcheck
sudo systemctl enable schedulecheck
sudo systemctl enable wavea
sudo systemctl enable waveb
sudo systemctl enable ato
sudo systemctl enable dose
sudo systemctl enable ldd
echo PLEASE REBOOT YOUR PI NOW TO ACTIVATE THESE SERVICES.
echo Once your Pi has booted up please check the services tab on the website.
echo Services should list as active.





