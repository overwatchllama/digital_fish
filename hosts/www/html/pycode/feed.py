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


GPIO.setwarnings(False)
GPIO.setmode(GPIO.BOARD)
# print "start"

def floatswitch():
	global switchgpio
	global switchgpioled
	curs = db.cursor()
	curs.execute ('SELECT * FROM generic_devices where id="1"')
	results = curs.fetchall()
	for row in results:
		global switchgpio
		switchgpio = (row[3])
		switchgpio = int(switchgpio)
		switchgpioled = (row[4])
		switchgpioled = int(switchgpioled)
	db.commit()
	curs = db.cursor()
	curs.execute ('SELECT * FROM generic_devices where id="2"')
	results = curs.fetchall()
	for row in results:
		global feedrelaygpio
		global polarity
		global pulse
		global pulsetime		
		global truestate
		global falsestate
		feedrelaygpio = (row[3])
		feedrelaygpio = int(feedrelaygpio)
		polarity = (row[6])
		polarity = int(polarity)		
		pulse = (row[7])
		pulse = int(pulse)
		pulsetime = (row[8])
		pulsetime = int(pulsetime)
		if polarity == 1:
			truestate=1
			falsestate=0
 # print"Relay in Active HIGH Mode"
		else:
			truestate=0
			falsestate=1
 # print "Relay in Active LOW Mode"
	db.commit()

x = 1
floatswitch()


# print "siwtch gpio & led gpio"
# print switchgpio
# print switchgpioled

# time.sleep(2)
# print "LED SETUP"

# print "LED SETUP-----"

try:		
	GPIO.setup(switchgpio, GPIO.IN, pull_up_down=GPIO.PUD_UP)
	# time.sleep(0.5)
except:
	donothing = 0
	# print "1************* Invalid Float Switch Gpio ************"
# print pulse


def flasher(x):
	for count in range (0,x):	 			
				GPIO.output(switchgpioled,0)
				GPIO.output(switchgpioled,1)
				time.sleep(0.25)
				GPIO.output(switchgpioled,0)
				time.sleep(0.25)
				GPIO.output(switchgpioled,1)
				time.sleep(0.25)
				GPIO.output(switchgpioled,0)
				time.sleep(0.25)
				

while switchgpio == 0:
	floatswitch()
	time.sleep(1)

while switchgpioled == 0:
	floatswitch()
	time.sleep(1)

if switchgpioled >0:
	GPIO.setup(switchgpioled, GPIO.OUT)
if feedrelaygpio >0:
	GPIO.setup(feedrelaygpio, GPIO.OUT)
y = 1
while True:
	try:
		input_state = GPIO.input(switchgpio)
	except:
		donothing = 0
	x = x + 1	
	# print x
	if x == 100000:
		floatswitch()
		y = y +1
		# print y
		# print feedrelaygpio
		# print x
		x = 1
		# time.sleep(1)
	# print x
	try:
		time.sleep(0.1)
		if input_state == False:
			# print('Dispensing Food')
			floatswitch()
			# for count in range (0,4):	 			
				# GPIO.output(switchgpioled,falsestate)
				# time.sleep(0.1)
				# GPIO.output(switchgpioled,truestate)
				# time.sleep(0.1)
				# GPIO.output(switchgpioled,falsestate)
			# flasher(1)	
			# print feedrelaygpio
			# pulse = pulse + 1
			
			if feedrelaygpio >0:
				for y in range (0,pulse):
					GPIO.output(feedrelaygpio,truestate)
					flasher(pulsetime)
					# print "Pulse"
					GPIO.output(feedrelaygpio,falsestate)
					time.sleep(pulsetime)
			else:
				# print "X"
				flasher(3)
			curs = db.cursor()
			curs.execute ('INSERT INTO  alert SET collection="rss", category="Feed", title="Fish Fed", message="Fish have just been fed via feed button."')
			db.commit()		
	except:
		donothing = 0
		
