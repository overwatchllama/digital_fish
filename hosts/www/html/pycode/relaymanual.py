import sys
import MySQLdb
import time
import RPi.GPIO as GPIO
import dbconnection

dbhost = dbconnection.dbhost()
dbuser = dbconnection.dbuser()
dbpasswd = dbconnection.dbpasswd()
dbname = dbconnection.dbname()
db = MySQLdb.connect (host = dbhost, user= dbuser, passwd=dbpasswd,db = dbname)
curs = db.cursor()

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)

x = 0
y = 0
while x == 0:
	y = y + 1
	time.sleep(1)	
	if (y == 1):
		# curs.execute ('SELECT * FROM codes WHERE code = "relaypolarity"')
		# results = curs.fetchall()
		# for row in results:
		        # polarity=row[2]
			# polarity=int(polarity)

		#print "polarity:" ,polarity
		# if polarity == 1:
		 # truestate=1
		 # falsestate=0
		 #print "Relay in Active HIGH Mode"
		# else:
		 # truestate=0
		 # falsestate=1
		 #print "Relay in Active LOW Mode"



		curs.execute ('SELECT * FROM relay_master WHERE auto = "0"')
		results = curs.fetchall()
		for row in results:
			gpio=row[9]
			state=row[16]
			name = row[1]
			polarity = row[17]
			polarity = int(polarity)
			if polarity == 1:
		 		truestate=1
		 		falsestate=0
		 		#print "Relay in Active HIGH Mode"
			else:
		 		truestate=0
		 		falsestate=1
		 #print "Relay in Active LOW Mode"
			# print "GPIO = ",gpio
			# print "STATE = ",state," ( *** 0=off 1=on *** )"
			if (state == 1):
				donothing = 0
				# print "Activating Relay",name, "on pin", gpio
				try:
					GPIO.setup(int(gpio), GPIO.OUT)
					GPIO.output(int(gpio), truestate)
				except:
					donothing = 0
					# print "Invalid GPIO"
			if (state == 0):
				donothing = 0
				# print "off"
				# print "Deactivating Relay",name, "on pin", gpio
				try:
					GPIO.setup(int(gpio), GPIO.OUT)
					GPIO.output(int(gpio), falsestate)
				except:
					donothing = 0
					# print "Invalid GPIO"

		db.commit()
		y = 0
