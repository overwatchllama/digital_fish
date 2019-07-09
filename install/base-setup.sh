path=http://www.digitalfish.net/setup/j5
find . -type f -not -name 'base-setup.sh' | xargs rm

f_curl(){
fname=${1}
curl -o $fname $path/$fname
}

f_curl sql.sqll $path/
f_curl cleanup.sqll
f_curl sqlpatch_password_reset.sqll
f_curl updatesql.sqll
f_curl patch.sqll
f_curl ibdata1flush.sh
f_curl ibdata1flush.sqll
f_curl ibdata1flush2.sqll

mv ibdata1flush.sqll ibdata1flush.sql
mv ibdata1flush2.sqll ibdata1flush2.sql
mv patch.sqll patch.sql
mv updatesql.sqll updatesql.sql
mv sql.sqll sql.sql
mv cleanup.sqll cleanup.sql
mv sqlpatch_password_reset.sqll sqlpatch_password_reset.sql

f_curl servicestop.sh
f_curl backup.sh
f_curl install-stretch.sh
f_curl patch.sh
f_curl patchupdate-password-reset.sh
f_curl post-install.sh
f_curl pycode-update.sh
f_curl restore.sh
f_curl service-install.sh
f_curl webupdate.sh
f_curl dbinstall.sh
f_curl uninstall-services.sh
f_curl upgrade.sh
f_curl resetpassword.sh
f_curl relaymanual.service
f_curl schedulecheck.service
f_curl thermcheck.service
f_curl wavea.service
f_curl waveb.service
f_curl ato.service
f_curl dose.service
f_curl ldd.service