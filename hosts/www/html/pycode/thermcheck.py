import datetime
import MySQLdb
import os
import dbconnection
import time

dbhost = dbconnection.dbhost()
dbuser = dbconnection.dbuser()
dbpasswd = dbconnection.dbpasswd()
dbname = dbconnection.dbname()
db = MySQLdb.connect (host = dbhost, user= dbuser, passwd=dbpasswd,db = dbname)


# This is where my temperature probe is being read, your serial number will be different.
# If your modules are set according to my article in PiMag and you have setup your probe as per Adafruit
# you should just have to change the serial number to yours



x=0
y = 0
while x==0:
  time.sleep(5)
  #print x
  y = y+1
  if (y == 61):
    y=0
  #print "YYYY:", y

  try:
    curs = db.cursor()
    cputemp = os.popen("/opt/vc/bin/vcgencmd measure_temp").read()
    # print cputemp
    f = cputemp
    result = f
    v = result.replace("\n","")
    w = v.replace("temp=","")
    cputemp = w.replace("'C","")
    #print cputemp
    curs.execute ("UPDATE piinfo SET value='%s' WHERE id=2" % (cputemp))
    db.commit()
  except:
    donothing = 0
    # print "Cpu Temperature Failed to Read"

  curs = db.cursor()
  curs.execute ("SELECT * FROM thermconfig")
  results=curs.fetchall()
  for i in results:
    therm_id=i[0]
    therm_shortname=i[1]
    therm_serial=i[2]
    #print therm_shortname
    try:
      #print "Attempt"
      #print therm_serial
      tfile = open("/sys/bus/w1/devices/%s/w1_slave" % (therm_serial)) 
      text = tfile.read()
      tfile.close()
      secondline = text.split("\n")[1]
      thermdata = secondline.split(" ")[9]
      # print thermdata
      therm = float(thermdata[2:])
      therm = therm / 1000
      # print therm
      therm = round(therm,2)
      # print "therm", therm
      if (y == 60):
        curs.execute ("INSERT thermlog SET id_thermconfig='%s', reading='%s', sensorname='%s';" % (therm_id,therm,therm_shortname))
      curs.execute ("UPDATE thermconfig SET current_therm='%s' where id='%s';" % (therm,therm_id))
      db.commit()
      db.close
    except:
      therm = 0
      # print therm
      # print "Fail To Read tfile - Temperature Sensor Serial '%s'" % (therm_serial)




