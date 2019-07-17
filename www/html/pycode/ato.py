#Import the library
import sys
import MySQLdb
import time
import RPi.GPIO as GPIO
import dbconnection

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)


dbhost = dbconnection.dbhost()
dbuser = dbconnection.dbuser()
dbpasswd = dbconnection.dbpasswd()
dbname = dbconnection.dbname()

db = MySQLdb.connect (host = dbhost, user= dbuser, passwd=dbpasswd,db = dbname)

def polarityfunction():
	global curs
	global truestate
	global falsestate
	curs = db.cursor()
	curs.execute ('SELECT * FROM ato_relay WHERE id = "1"')
	results = curs.fetchall()
	for row in results:
		global polarity
		polarity=row[6]
		polarity=int(polarity)

	#print "polarity:" ,polarity
	if polarity == 1:
		truestate=1
		falsestate=0
		#print "Relay in Active HIGH Mode"
	else:
		truestate=0
		falsestate=1
		#print "Relay in Active LOW Mode"
	db.commit()



# def getdata():
# 	curs.execute ('SELECT * FROM ato_relay where id="1"')
# 	results = curs.fetchall()
# 	for row in results:
		# global gpio
		# gpio = (row[3])
		# gpio = int(gpio)
	# db.commit()


def dispense():	
	curs.execute ('SELECT * FROM ato_relay where id="1"')
	results = curs.fetchall()
	for row in results:
		global gpio		
		gpio = (row[3])
		#print gpio
		runtime = (row[2])
		ml = (row[5])
		#print "GPIO: " +str(gpio) +  "\n--- Dispensing Seconds: " + str(runtime) + "\n--- Approx Volume Dispensed: " +str(ml)
		try:
			GPIO.setup(int(gpio), GPIO.OUT)
			GPIO.output(int(gpio), truestate)
			time.sleep(float(runtime))
			GPIO.output(int(gpio), falsestate)
			time.sleep(float(runtime))
			# FIX THIS - WRITING CONSTANTLY
			curs.execute ("INSERT event SET event='ato', value='1', dateset=CURRENT_TIMESTAMP, timeset=CURRENT_TIMESTAMP, value_1='%s';" % (ml))
			curs.execute ('INSERT INTO  alert SET collection="rss", category="Ato", title="ATO - Dispense", message="Top off water has been dispensed."')
			db.commit()
			
		except:
			donothing = 0
			# print "GPIO %s" % (gpio)
			# print "************** Invalid GPIO Numner *******************"			
		db.commit()
		# db.close()

def empty():	
	curs.execute ('INSERT INTO  alert SET collection="rss", category="Ato", title="ATO - FAIL", message="Resevoir EMPTY"')
	db.commit()



def floatswitch():
	curs = db.cursor()
	curs.execute ('SELECT * FROM ato_relay where id="1"')
	results = curs.fetchall()
	try:
		for row in results:
			global switchgpio
			global failswitchgpio
			global resevoirgpio
			switchgpio = (row[4])
			switchgpio = int(switchgpio)
			failswitchgpio  = (row[7])
			failswitchgpio = int(failswitchgpio)
			resevoirgpio = (row[8])
			resevoirgpio = int(resevoirgpio)
	except:
		donothing = 0
	db.commit()

polarityfunction()
floatswitch()
count = 1
float3count = 1
while True:	
	count = count + 1
	# print count
	if count == 100:
		polarityfunction()
		floatswitch()
		count = 1
	time.sleep(0.05)
	try:
		GPIO.setup(switchgpio, GPIO.IN, pull_up_down=GPIO.PUD_UP)
		GPIO.setup(failswitchgpio, GPIO.IN, pull_up_down=GPIO.PUD_UP)
		try:
			GPIO.setup(resevoirgpio, GPIO.IN, pull_up_down=GPIO.PUD_UP)
		except:
			float3=1
		
		float1 = GPIO.input(switchgpio)
		float2 = GPIO.input(failswitchgpio)
		try:
			float3 = GPIO.input(resevoirgpio)
		except:
			float3=1
		
	except:
		donothing = 0
		# print "************* Except 1 **********"
	try:
		# print "%s %s" % (switchgpio,float1)
		# print "%s %s" % (failswitchgpio,float2)		
		decision = float1 + float2 + float3
		if decision == 0:
			# print "Stop Dispensing"
			GPIO.output(int(gpio), falsestate)
			exit
		if float1 == False:
			if float2 + float3 == 2:				
				# print('Dispensing Water')
				dispense()
		if float3 == 0:
			# print "empty"
			# print float3count
			float3count = float3count+1
			if float3count > 36000:
				# print float3count
				empty()
				float3count = 1
			
				


		else:
			donothing = 0
			# print float1
			# print float2
			# print float3			
			# print "Not Dispensing"
			

	except:
		donothing = 0
		# print "************ Except 2 ************"
