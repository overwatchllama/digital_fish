#Import the library
import sys
import MySQLdb
import time as wait
import RPi.GPIO as GPIO
import dbconnection

GPIO.setwarnings(False)

dbhost = dbconnection.dbhost()
dbuser = dbconnection.dbuser()
dbpasswd = dbconnection.dbpasswd()
dbname = dbconnection.dbname()
db = MySQLdb.connect (host = dbhost, user= dbuser, passwd=dbpasswd,db = dbname)
curs = db.cursor()
global debug
debug = 0

curs.execute ('SELECT * FROM codes WHERE code = "thermtype"')
results = curs.fetchall()
for row in results:
	global thermtype
	thermtype=row[2]



# print "polarity:" ,polarity
# if polarity == 1:
 # truestate=1
 # falsestate=0
 # print "Relay in Active HIGH Mode"
# else:
 # truestate=0
 # falsestate=1
 # print "Relay in Active LOW Mode"

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
try:
	donothing = ""
	
except:
	donothing = 1
	if debug == 1:
		print "NO TIME SLOT OFFERED"

curs.execute ('SELECT * FROM relay_master')
results = curs.fetchall()
for row in results:
	name = (row[1])
	if (sys.argv[1] == "sunrise"):
		phase = (row[2])
	if (sys.argv[1] == "morning"):
		phase = (row[3])
	if (sys.argv[1] == "daytime"):
		phase = (row[4])
	if (sys.argv[1] == "afternoon"):
		phase = (row[5])
	if (sys.argv[1] == "sunset"):
			phase = (row[6])
	if (sys.argv[1] == "night"):
			phase = (row[7])
	if (sys.argv[1] == "nolight"):
			phase = (row[8])
	gpio = (row[9])
	auto = (row[10])
	thermconfig_id = (row[11])
	therm_low_value = (row[12])
	therm_low_decision = (row[13])
	therm_high_value = (row[14])
	therm_high_decision = (row[15])
	relayid = (row[0])
	polarity = (row[17])
	polarity = int(polarity)
	if polarity == 1:
 		truestate=1
 		falsestate=0
 	# print "Relay in Active HIGH Mode"
	else:
 		truestate=0
 		falsestate=1
	try:
		GPIO.setwarnings(False)
		GPIO.setup(int(gpio), GPIO.OUT)
	except:
		donothing = 0
		# print "Bad GPIO Used"
	
	if (thermconfig_id == 0):
		donothing = ""

	else:
		tempid = int(thermconfig_id)
		# print "Therm ID is : ", tempid
		curs.execute ("SELECT * FROM thermconfig WHERE id=%s" % (tempid))
		results = curs.fetchall()
		for row in results:
			temp = (row[3])
			temp = float(temp)
			temp = round(temp)
			if thermtype =="0":
				temp = int(temp) * 9/5+32
			# print temp
			# print thermtype
			# print "Temperature is:",temp, "Celcius and ", int(temp) * 9/5+32 , "Farenheit"

	if (auto == 1):
		if (thermconfig_id == 0):
			if debug == 1:
				print 'phase:',phase,'truestate:',truestate,'gpio:',gpio, 'name:',name
			if (int(phase) == 1):
			# print "No Therm Config Set Resuming normal action"
				try:
					if gpio==0:
						donothing=0
					else:
						GPIO.output(int(gpio), truestate)
						curs.execute ("UPDATE relay_master SET state='1' WHERE id=%s" % (relayid))
						db.commit()
				except:
					donothing=0
					if debug == 1:
						print "Failure #1"
			
			if (int(phase) == 0):
				try:# print "No Therm Config Set Resuming normal action"
					if gpio==0:
						donothing=0
					else:
						GPIO.output(int(gpio), falsestate)
						curs.execute ("UPDATE relay_master SET state='0' WHERE id=%s" % (relayid))
						db.commit()
				except:
					donothing=0
					if debug == 1:
						print "Failure #2"
			else:
				donothing=0
			
			
			
		else:
			# print name , "Temperature is :" , temp
			try:
				if (float(temp) < therm_low_value ):
					if debug == 1:
						print "Therm has exceeded LOW need to action X"
					if (therm_low_decision == 1):
						# print "Therm is lower than threshold switching realy on"
						GPIO.output(int(gpio), truestate)
						curs.execute ("UPDATE relay_master SET state='1' WHERE id=%s" % (relayid))
						db.commit()
					if (therm_low_decision == 0):
						GPIO.output(int(gpio), falsestate)
						curs.execute ("UPDATE relay_master SET state='0' WHERE id=%s" % (relayid))
						db.commit()
			except:
				donothing = 1
				if debug == 1:
					print "Failure #3"
			
			try:
				if (float(temp) > therm_low_value):
						if (float(temp) < therm_high_value):
							if (int(phase) == 1):
								if debug==1:
									print "***************************ENTERING THIS LOGIC"
									print float(temp), therm_high_value
									print name
									print "Therm is in between range listening to phase rule - switch on for this phase"
								GPIO.output(int(gpio), truestate)
								curs.execute ("UPDATE relay_master SET state='1' WHERE id=%s" % (relayid))
								db.commit()
							if (int(phase) == 0):
								if debug==1:
									print "############################"
									print "Therm is in between range: listening to phase rule - switch OFF for this phase."
								GPIO.output(int(gpio), falsestate)
								curs.execute ("UPDATE relay_master SET state='0' WHERE id=%s" % (relayid))
								db.commit()
			except:
				donothing = 1
				if debug == 1:
					print "Failure #4"
			
			try:
				if (float(temp) > therm_high_value ):
					# print "Therm had exceeded HIGH need to action X"
					if (therm_high_decision == 1):
						GPIO.output(int(gpio), truestate)
						curs.execute ("UPDATE relay_master SET state='1' WHERE id=%s" % (relayid))
						db.commit()
					if (therm_high_decision == 0):
						GPIO.output(int(gpio), falsestate)
						curs.execute ("UPDATE relay_master SET state='0' WHERE id=%s" % (relayid))
						db.commit()
				else:
					donothing = 0					
			except:
				donothing = 1
				if debug == 1:
					print "Failure #5"
	else:
		donothing = ""

db.close()
