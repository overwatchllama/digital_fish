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


curs = db.cursor()
curs.execute ("SELECT * FROM thermconfig")
results=curs.fetchall()

for i in results:
  therm_id=i[0]
  therm_shortname=i[1]
  therm_serial=i[2]
  print "NOT WRITING TO SQL !!! Test Only"
  print "Therm being tested is:" + therm_shortname
  try:
    print "Attempt in to pull data from:   " + therm_serial
    tfile = open("/sys/bus/w1/devices/%s/w1_slave" % (therm_serial)) 
    text = tfile.read()
    tfile.close()
    secondline = text.split("\n")[1]
    thermdata = secondline.split(" ")[9]
    therm = float(thermdata[2:])
    therm = therm / 1000
    print "Result in celcius is:  %s" % (therm)
    print "\n"
  except:
      print "FAILURE"
