#Import the library
import sys
import MySQLdb
import time as wait
import RPi.GPIO as GPIO
import subprocess
import dbconnection
import time
from subprocess import call

try:
	if (sys.argv[1] == "test"):
		debug=1
	else:
		debug=0		
except:
	donothing = 0 #No reponserequired


from subprocess import call
call(["clear"])

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)

dbhost = dbconnection.dbhost()
dbuser = dbconnection.dbuser()
dbpasswd = dbconnection.dbpasswd()
dbname = dbconnection.dbname()
db = MySQLdb.connect (host = dbhost, user= dbuser, passwd=dbpasswd,db = dbname)
global start
start = 1

global curs
curs = db.cursor()
curs.execute ('''SELECT * FROM relay_dose''')
results = curs.fetchall()

print "- - - - - - - - - - - - -"
print "CALIBRATION"
print "- - - - - - - - - - - - -"


for row in results:
	doseid=row[0]	
	mls=row[5]
	global description
	description=row[4]
	state=row[2]
	dosegpio=row[3]
	global polarity
	polarity=row[1]
	polarity = int(polarity)
	if polarity == 1:
 		truestate=1
 		falsestate=0
	else:
 		truestate=0
 		falsestate=1
	
	try:
		print ""

		GPIO.setup(int(dosegpio), GPIO.OUT)
		print "CALIBRATE", ">>>>>>>>>>>>>>>>>>>>>>>>>",description,"<<<<<<<<<<<<<<<<<<<<<<<<<<<"
		print ""
		usertime = input ("Enter seconds to prime / expell air / OR Press Enter to skip to next relay: ")
		print ""
		print "Priming"
		GPIO.output(int(dosegpio), truestate)
		time.sleep(usertime)
		GPIO.output(int(dosegpio), falsestate)
		print ""
		print "Now that it is primed"
		print "POSITION A MEASURING BEAKER TO CAPTURE THE NEXT DISPENSE"
		usertime2 = input ("Enter seconds to run pump, to calculate millitres per second (10 at least): ")
		print ""
		print "Dispensing"
		GPIO.output(int(dosegpio), truestate)
		time.sleep(usertime2)
		GPIO.output(int(dosegpio), falsestate)
		print ""
		data = input ("How many millilitres were dispensed: ")
		print ""
		answer = round(data,2) / round(usertime2,2)
		permlreate = 1 / round(answer,2)
		permlreate = round(permlreate,2)
		dipensingvolume = round(data,2) / round(usertime2,2)
		print "WE HAVE CONFIGURED YOUR DOSE RELAY - CHECK THE WEBSITE."
		print "Your Dispensing will be ",dipensingvolume,"millilitres per second"
		print "Your time to get 1ml is : ", permlreate, " seconds."
		print "Meaning if you wanted 5ml, your timing would be ", round(permlreate,2)," x 5 "
		print "The answer to this example would be ", round(permlreate,2) * 5.," seconds."
		print "-----------------------------------------------------------------"
		print ""
		curs.execute ('''UPDATE relay_dose SET mls=%s WHERE id=%s''' % (answer,doseid))
		db.commit()

	
	
	except:
		donothing = 0

