sudo systemctl stop relaymanual
sudo systemctl stop thermcheck
sudo systemctl stop schedulecheck
sudo systemctl stop wavea
sudo systemctl stop waveb
sudo systemctl stop ato
sudo systemctl stop feed
sudo systemctl stop dose
sudo systemctl stop ldd

sudo systemctl disable relaymanual
sudo systemctl disable thermcheck
sudo systemctl disable schedulecheck
sudo systemctl disable wavea
sudo systemctl disable waveb
sudo systemctl disable ato
sudo systemctl disable feed
sudo systemctl disable dose
sudo systemctl disable ldd

sudo rm /etc/systemd/system/relaymanual.service
sudo rm /etc/systemd/system/thermcheck.service
sudo rm /etc/systemd/system/schedulecheck.service
sudo rm /etc/systemd/system/wavea.service
sudo rm /etc/systemd/system/waveb.service
sudo rm /etc/systemd/system/ato.service
sudo rm /etc/systemd/system/feed.service
sudo rm /etc/systemd/system/dose.service
sudo rm /etc/systemd/system/ldd.service

systemctl daemon-reload
systemctl reset-failed