#!/usr/bin/python

from Adafruit_PWM_Servo_Driver import PWM
import time
import dbconnection
import sys
import MySQLdb
import subprocess
from multiprocessing import Process


dbhost = dbconnection.dbhost()
dbuser = dbconnection.dbuser()
dbpasswd = dbconnection.dbpasswd()
dbname = dbconnection.dbname()
db = MySQLdb.connect (host = dbhost, user= dbuser, passwd=dbpasswd,db = dbname)
curs = db.cursor()

# Initialise the PWM device using the default address

pwm = PWM(0x40)
pwm.setPWMFreq(1000)                        # Set frequency to 60 Hz

def leddim(channel,a,b,c):
	for x in range (a,b,c):
		pwm.setPWM(channel,0,x)
		time.sleep(0.01)

def rampup(y):
	for x in range (0,4000,y):
		pwm.setPWM(0,0, x)
		#time.sleep(0.01)

def rampdown(z):
	for x in range (4000,0,z):
		pwm.setPWM(0,0,x)


try:
	curs.execute ("UPDATE ledim SET state='0';")
	db.commit()
except:
	donothing=0
x = 1
while x == 1:
	curs.execute ('SELECT phase FROM sched')
	results = curs.fetchall()
	for row in results:
		currentphase = (row[0])
		print currentphase
	# count = 1
	
	
	curs.execute ("SELECT * FROM ledim where phase='%s'" % (currentphase))
	results = curs.fetchall()
	for row in results:
		ids = (row[0])
		led_id = (row[1])
		start = (row[2])
		end = (row[3])
		speed = (row[4])
		state = (row[5])
		phase = (row[6])
		channel = (row[7])
		auto = (row[8])
		manual = (row[9])
		# print therun[xx]
		# print count
		if auto == 1:
			if state == 0:
				print ids
				# processes = [mp.Process(target = leddim(channel,start,end,speed))]
				Process(target=leddim, args=(channel,start,end,speed)).start()
			try:
				curs.execute ("UPDATE ledim SET state='1' WHERE id='%s';" % (ids))
				curs.execute ("UPDATE ledim SET state='0' WHERE phase<>'%s';" % (phase))
				db.commit()
			except:
				donothing=0
			# count = count+1
		else:
			print manual
			leddim(channel,(manual-1),manual,1)
			try:
				curs.execute ("UPDATE ledim SET state='0' WHERE id='%s';" % (ids))
				db.commit()
			except:
				donothing=0
	
	time.sleep(5)
	# output = [p.get() for p in results]
	
#pwm.setPWM(0,0,0)
