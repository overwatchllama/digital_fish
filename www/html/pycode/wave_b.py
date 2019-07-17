import RPi.GPIO as GPIO
import time
import MySQLdb

db = MySQLdb.connect (host = "127.0.0.1", user = "jayfish", passwd="JayFish1$", db = "jayfish")

def dbasecheck():
	curs = db.cursor()
        curs.execute ('SELECT phase FROM sched WHERE  id="0"')
        results = curs.fetchall()
        for row in results:
        	global phase
        	phase=row[0]
        	phase=str(phase)
        	phasephrase = ("The Current Schedule State is : ")
        	#print phasephrase + phase

        curs.execute ('SELECT wave_b_pulse FROM relay_wave_phase WHERE description="%s"' % (phase))
        results = curs.fetchall()
        for row in results:
                global pulse
                pulse=row[0]
		
		pulse=float(pulse)
		pulsephrase = ("Pulsing For ")
		suffix = (" seconds")
		#print pulsephrase + str(pulse) + suffix

	curs.execute ('SELECT wave_b_rest FROM relay_wave_phase WHERE description="%s"' % (phase))
        results = curs.fetchall()
        for row in results:
                global rest
                rest=row[0]
                rest=float(rest)
        restphrase = ("Resting For ")
        # print restphrase + str(rest) + suffix

	curs.execute ('SELECT wave_b_state FROM relay_wave_phase WHERE description="%s"' % (phase))
        results = curs.fetchall()
        for row in results:
                global state
                state=row[0]
                # state=int(state)
        # print ("Wave Maker B is ") + state
global truestate
global falsestate
global polarity        # print (".\n.\n.")


def runprogram():
	if state==("off"):
		# print "off"
		curs = db.cursor()
		curs.execute ('SELECT * FROM relay_wave WHERE id = "1"')
		results = curs.fetchall()
		for row in results:
			# global truestate
			# global falsestate
			# global polarity
			polarity=row[4]
			polarity=int(polarity)
			# print "polarity:" ,polarity

		if polarity == 1:
			truestate=1
			falsestate=0
			# print "Relay in Active HIGH Mode"
		else:
			truestate=0
			falsestate=1
			# print "Relay in Active LOW Mode"
		db.commit()
		GPIO.output(gpio, falsestate )
		time.sleep(2)
		# print ("Wave maker has been disabled - state off")
	else:
		# -----------------
		curs = db.cursor()
		curs.execute ('SELECT * FROM relay_wave WHERE id = "2"')
		results = curs.fetchall()
		for row in results:
			# global polarity
			# global truestate
			# global falsestate
			polarity=row[4]
			polarity=int(polarity)
			# print "polarity:" ,polarity

		if polarity == 1:
			truestate=1
			falsestate=0
			# print "Relay in Active HIGH Mode"
		else:
			truestate=0
			falsestate=1
			# print "Relay in Active LOW Mode"
		db.commit()

		# -----------------
		for i in range(0,4):
			# print "on"
			GPIO.output(gpio, truestate )
			time.sleep(pulse)
			GPIO.output(gpio, falsestate )
			time.sleep(rest)
			# print ("Active")
x=1
pulsecount = 1
while x==1:
	curs = db.cursor()
	curs.execute ('SELECT gpio FROM relay_wave WHERE name ="wave_b"')
	results = curs.fetchall()
	for row in results:
		global gpio
		gpio=row[0]
		gpio=int(gpio)
		GPIO.setwarnings(False)
		GPIO.setmode(GPIO.BOARD)
		try:
			GPIO.setup(gpio, GPIO.OUT)
		except:
			donothing = 0
			# print "Bad GPio"
			time.sleep(2)
		db.commit()
	dbasecheck()
	try:
		runprogram()
	except:
		donothing = 0
		# print "Failed Probable Cause GPIO 0 Meaning = Disabled"
	# print ("Pulsed ") + str(pulsecount ) + (" times")
	pulsecount = pulsecount + 1
	curs = db.cursor()
	db.commit()

	


