#Import the library
import sys
import MySQLdb
import time as wait
import RPi.GPIO as GPIO
import subprocess
import dbconnection
import time
from subprocess import call


debug = 0

try:
	test = sys.argv[1]
	if (test == "test"):
		debug=1
	else:
		debug=0		
except:
	donothing = 0 #No reponserequired



GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)

dbhost = dbconnection.dbhost()
dbuser = dbconnection.dbuser()
dbpasswd = dbconnection.dbpasswd()
dbname = dbconnection.dbname()
db = MySQLdb.connect (host = dbhost, user= dbuser, passwd=dbpasswd,db = dbname)
global start
start = 1

from datetime import datetime, time,date
now = datetime.now()
now_time = now.time()


import time 
# global dayoftheweek
# dayoftheweek = time.strftime("%w")
# print dayoftheweek

def whatdayisit(x):
	x = int(x)
	if x == 0:
		print "Sunday"
	else:
		donothing = 0
	if x == 1:
		print "Monday"
	else:
		donothing = 0
	if x == 2:
		print "Tuesday"
	else:
		donothing = 0
	if x == 3:
		print "Wednesday"
	else:
		donothing = 0
	return x

while start == 1:
	global dayoftheweek
	dayoftheweek = time.strftime("%w")

	time.sleep(2)
	
	curs = db.cursor()
	curs.execute ('''SELECT * FROM relay_dose_sched t1 INNER JOIN relay_dose t2 WHERE t2.id = t1.relay_dose_id ORDER by day,time''')
	results = curs.fetchall()
	for row in results:

		dose_sched_id=row[0]
		dose_id=row[6]
		global day
		day=row[1]
		timeset=row[2]
		seconds=row[3]	
		dosecompleted=row[5]
		description=row[10]
		global dosegpio
		dosegpio=row[9]
		state=row[8]
		global polarity
		polarity=row[7]
		polarity = int(polarity)
		# print "polarity:" ,polarity
		if polarity == 1:
	 		truestate=1
	 		falsestate=0
	 # print "Relay in Active HIGH Mode"
		else:
	 		truestate=0
	 		falsestate=1
	 # print "Relay in Active LOW Mode"
		
			
		# print "!!!!",dosegpio
		try:
			GPIO.setup(int(dosegpio), GPIO.OUT)
		except:
			donothing = 0		
			if debug == 1:
				print "WARNING: Invalid GPIO is being used for:", description, "scheduled for day:",day,"\nIf the GPIO is 0 its acceptable as indicating *** THIS DOSER IS DISABLED and this can be ignored\n"
			if state==0:
				if debug == 1:
					print "*** THIS DOSER IS DISABLED"
			if debug == 1:
				print "-------------------------------------------------------------------------"


		currenttime=(time.strftime("%H:%M:%S"))
		timeset = str(timeset)
		import datetime
		nowtime = datetime.datetime.strptime(currenttime, "%H:%M:%S")
		dosetime = datetime.datetime.strptime(timeset, "%H:%M:%S")
		postime = dosetime + datetime.timedelta(seconds=300)
		if day==int(dayoftheweek):
			action = "Match"
			if state==0:
				donothing=0
			else:
				if dosecompleted==0:
					
					if nowtime >= dosetime and nowtime <=postime:
						if debug == 1:
							print "-------------- Now Dose Chemical ---------------"
							print "Performing Dose",description
							print "GPIO ON", dosegpio,dose_sched_id
						try:
							if debug == 1:
								print "doing truestate",truestate
							curs.execute ('INSERT INTO  alert SET collection="rss", category="Dosing", title="%s", message="The Dose %s has been dispensed."' % (description,description))
							db.commit()	
							GPIO.output(int(dosegpio), truestate)
						except:
							donothing = 0
						time.sleep(seconds)								
						try:
							GPIO.output(int(dosegpio), falsestate)
						except:
							donothing = 0
						if debug == 1:
							print "GPIO OFF"
							print "SQL set dosecompleted to 1", dose_sched_id
						curs.execute ('''UPDATE relay_dose_sched SET dosecompleted="1" WHERE id="%s"''' % (dose_sched_id))
						db.commit()
					else:
						# print "DO NOTHING !!!!"
						donothing=0
				else:
					if debug == 1:
						print "\nStatus:  The dispense below as already Dispensed\n"
					curs.execute ('''UPDATE relay_dose_sched SET dosecompleted="0" WHERE day<>%s''' % (dayoftheweek))
					db.commit()
		else:
			donothing = 0
			action = "No Match"
		
		if day==int(dayoftheweek):
			if debug == 1:
				print "-------------------------------------------------------------------------"
				if state==0:
					print "*** THIS DOSER IS DISABLED"
				print "Dose Item:\t", description,"\n"
				print "Dose time\t","Post time\t\t","Now time\t"
				print  timeset,"\t",postime,"\t",currenttime,"\n"
				print "id","\t","shed_id","\t","day","\t","dosetime","\t","action","\t","dosecompleted"
				print  dose_id ,"\t", dose_sched_id,"\t\t", day,"\t", timeset,"\t", action,"\t", dosecompleted
				print "\nDay Sched\t","Day of the week\t"
				print day,"\t\t",dayoftheweek
				print "-------------------------------------------------------------------------"
			else:
				donothing=0
		db.commit()
