#Import the library
import MySQLdb
#import time as wait
import RPi.GPIO as GPIO
import subprocess
import dbconnection
import time
from subprocess import call

GPIO.setwarnings(False)

dbhost = dbconnection.dbhost()
dbuser = dbconnection.dbuser()
dbpasswd = dbconnection.dbpasswd()
dbname = dbconnection.dbname()
db = MySQLdb.connect (host = dbhost, user= dbuser, passwd=dbpasswd,db = dbname)
global start
debug = 0
start = 1

def run_sched():
	global setup
	global start
	try:
		if (setup == 0):
			donothing = ""
	except:
		global sunrise
		global morning
		global daytime
		global afternoon
		global sunset
		global night
		global nolight
		sunrise = 0
		morning = 0
		daytime = 0
		afternoon = 0
	 	sunset = 0
	 	night = 0
	 	nolight = 0

	# Feeding
	def feed(feedvalue):
		# print "---1"
		# print "----"
		# print feedvalue
		# print "----"
		curs = db.cursor()
		curs.execute ('SELECT * FROM schedaction WHERE description="%s"' % (feedvalue))
		# curs.execute ('SELECT * FROM schedaction WHERE description="night"')
		results = curs.fetchall()
		# print "---2"
		for row in results:
			# print "-------2"
			checkfeed = row[3]
			checkfeed_result = row[4]
			if checkfeed == 1:
				# print "---3"
				# print "Running Feed Routine"
				donothing = 0
				if checkfeed_result == 1:
					# print "---4"
					# print "Feeding"
					# print "Then set result to 0"
					subprocess.call("sudo python /var/www/html/pycode/feed_bysched.py", shell=True)
					# print "---5"
					curs.execute ('UPDATE schedaction SET feed_result = 0 WHERE description="%s"' % (feedvalue))
					db.commit()
		db.commit()
		# print "---9"

	def feedreset(feedvalue):
		curs = db.cursor()
		curs.execute ('UPDATE schedaction SET feed_result=1 WHERE description!="%s" AND feed=1' % (feedvalue))
		db.commit()



	# print start
	if (start == 1):
		# global sunrise
		# global morning
		# global daytime
		# global sunset
		# global night
		# global nolight
		sunrise = 1
		morning = 1
		daytime = 1
		afternoon = 1
	 	sunset = 1
	 	night = 1
	 	nolight = 1
	setup = 1
	#START
	# db = MySQLdb.connect (host = "192.168.1.61", user="root", passwd="8900428Mjvdh",db = "jayfish")
	#Define the writing cursor point
	curs = db.cursor()
	curs.execute ('SELECT * FROM sched')
	results = curs.fetchall()
	for row in results:
		sunrise_start=row[1]
		sunrise_end=row[2]
		morning_start=row[3]
		morning_end=row[4]
		daytime_start=row[5]
		daytime_end=row[6]
		afternoon_start=row[7]
		afternoon_end=row[8]
		sunset_start=row[9]
		sunset_end=row[10]
		night_start=row[11]
		night_end=row[12]
		nolight_start=row[13]
		nolight_end=row[14]

		if debug == 1:
			print "SCHEDULES"
			print 'sunrise',sunrise_start, sunrise_end
			print 'morning',morning_start, morning_end
			print 'daytime',daytime_start, daytime_end
			print 'afternoon',afternoon_start, afternoon_end
			print 'sunset',sunset_start, sunset_end
			print 'night',night_start, night_end
			print 'nolight',nolight_start, nolight_end
			print "SCHEDULES END"

		a=sunrise_start.split(":")
		sunrise_start_hour=a[0]
		sunrise_start_min=a[1]

		b=sunrise_end.split(":")
		sunrise_end_hour=b[0]
		sunrise_end_min=b[1]
		
		c=morning_start.split(":")
		morning_start_hour=c[0]
		morning_start_min=c[1]

		d=morning_end.split(":")
		morning_end_hour=d[0]
		morning_end_min=d[1]

		e=daytime_start.split(":")
		daytime_start_hour=e[0]
		daytime_start_min=e[1]

		f=daytime_end.split(":")
		daytime_end_hour=f[0]
		daytime_end_min=f[1]

		m=afternoon_start.split(":")
		afternoon_start_hour=m[0]
		afternoon_start_min=m[1]

		n=afternoon_end.split(":")
		afternoon_end_hour=n[0]
		afternoon_end_min=n[1]

		g=sunset_start.split(":")
		sunset_start_hour=g[0]
		sunset_start_min=g[1]

		h=sunset_end.split(":")
		sunset_end_hour=h[0]
		sunset_end_min=h[1]

		i=night_start.split(":")
		night_start_hour=i[0]
		night_start_min=i[1]

		j=night_end.split(":")
		night_end_hour=j[0]
		night_end_min=j[1]

		k=nolight_start.split(":")
		nolight_start_hour=k[0]
		nolight_start_min=k[1]

		l=nolight_end.split(":")
		nolight_end_hour=l[0]
		nolight_end_min=l[1]

	
	#END

	from datetime import datetime, time,date
	now = datetime.now()
	now_time = now.time()

	
	if now_time >= time(int(sunrise_start_hour),int(sunrise_start_min)) and now_time <= time(int(sunrise_end_hour),int(sunrise_end_min)):
	 if debug == 1:
	 	print ("Base on NOW time using Sunrise")
	 curs.execute ('UPDATE sched SET phase="sunrise" WHERE id="0"')
	 curs.execute ('UPDATE sched SET lastupdate=CURRENT_TIMESTAMP WHERE id="0"')
	 
	 if (sunrise == 0):
	 	curs.execute ('INSERT INTO  alert SET collection="rss", category="Phase", title="Phase Change", message="Phase Just Changed To: Sunrise"')
	 db.commit()
	 sunrise = 1
	 morning = 0
	 daytime = 0
	 afternoon = 0
	 sunset = 0
	 night = 0
	 nolight = 0

	 # feed
	 feed("sunrise")
	 feedreset("sunrise")
	 
	 subprocess.call("sudo python /var/www/html/pycode/relayphase-check.py sunrise", shell=True)


	if now_time >= time(int(morning_start_hour),int(morning_start_min)) and now_time <= time(int(morning_end_hour),int(morning_end_min)):
	 if debug == 1:
	 	print ("Base on NOW time using Morning") #REM
	 curs.execute ('UPDATE sched SET phase="morning" WHERE id="0"')
	 curs.execute ('UPDATE sched SET lastupdate=CURRENT_TIMESTAMP WHERE id="0"')
	 	 
	 if (morning == 0):
	 	curs.execute ('INSERT INTO  alert SET collection="rss", category="Phase", title="Phase Change", message="Phase Just Changed To: Morning"')
	 db.commit()
	 sunrise = 0
	 morning = 1
	 daytime = 0
	 afternoon = 0
	 sunset = 0
	 night = 0
	 nolight = 0

	 # feed
	 feed("morning")
	 feedreset("morning")

	 subprocess.call("sudo python /var/www/html/pycode/relayphase-check.py morning", shell=True)

	if now_time >= time(int(daytime_start_hour),int(daytime_start_min)) and now_time <= time(int(daytime_end_hour),int(daytime_end_min)):
	 if debug == 1:
	 	print ("Base on NOW time using Daytime") #REM
	 curs.execute ('UPDATE sched SET phase="daytime" WHERE id="0"')
	 curs.execute ('UPDATE sched SET lastupdate=CURRENT_TIMESTAMP WHERE id="0"')
	 
	 if (daytime == 0):
	 	curs.execute ('INSERT INTO  alert SET collection="rss", category="Phase", title="Phase Change", message="Phase Just Changed To: Daytime"')
	 db.commit()
	 sunrise = 0
	 morning = 0
	 daytime = 1
	 afternoon = 0
	 sunset = 0
	 night = 0
	 nolight = 0

	 # feed
	 feed("daytime")
	 feedreset("daytime")

	 subprocess.call("sudo python /var/www/html/pycode/relayphase-check.py daytime", shell=True)

	if now_time >= time(int(afternoon_start_hour),int(afternoon_start_min)) and now_time <= time(int(afternoon_end_hour),int(afternoon_end_min)):
	 if debug == 1:
	 	print ("Base on NOW time using Afternoon") #REM
	 curs.execute ('UPDATE sched SET phase="afternoon" WHERE id="0"')
	 curs.execute ('UPDATE sched SET lastupdate=CURRENT_TIMESTAMP WHERE id="0"')

	 if (afternoon == 0):
	 	curs.execute ('INSERT INTO  alert SET collection="rss", category="Phase", title="Phase Change", message="Phase Just Changed To: Afternoon"')
	 db.commit()
	 sunrise = 0
	 morning = 0
	 daytime = 0
	 afternoon = 1
	 sunset = 0
	 night = 0
	 nolight = 0

	 # feed
	 feed("afternoon")
	 feedreset("afternoon")

	 subprocess.call("sudo python /var/www/html/pycode/relayphase-check.py afternoon", shell=True)

	if now_time >= time(int(sunset_start_hour),int(sunset_start_min)) and now_time <= time(int(sunset_end_hour),int(sunset_end_min)):
	 if debug == 1:
	 	print ("Base on NOW time using Sunset") #REM
	 curs.execute ('UPDATE sched SET phase="sunset" WHERE id="0"')
	 curs.execute ('UPDATE sched SET lastupdate=CURRENT_TIMESTAMP WHERE id="0"')
	 
	 if (sunset == 0):
	 	curs.execute ('INSERT INTO  alert SET collection="rss", category="Phase", title="Phase Change", message="Phase Just Changed To: Sunset"')
	 db.commit()
	 sunrise = 0
	 morning = 0
	 daytime = 0
	 afternoon = 0
	 sunset = 1
	 night = 0
	 nolight = 0

	 # feed
	 feed("sunset")
	 feedreset("sunset")

	 subprocess.call("sudo python /var/www/html/pycode/relayphase-check.py sunset", shell=True)	

	if now_time >= time(int(night_start_hour),int(night_start_min)) and now_time <= time(int(night_end_hour),int(night_end_min)):
	 if debug == 1:
	 	print ("Base on NOW time using Night") #REM
	 curs.execute ('UPDATE sched SET phase="night" WHERE id="0"')
	 curs.execute ('UPDATE sched SET lastupdate=CURRENT_TIMESTAMP WHERE id="0"')
	 
	 if (night == 0):
	 	curs.execute ('INSERT INTO  alert SET collection="rss", category="Phase", title="Phase Change", message="Phase Just Changed To: Night"')
	 db.commit()
	 sunrise = 0
	 morning = 0
	 daytime = 0
	 afternoon = 0
	 sunset = 0
	 night = 1
	 nolight = 0

	 # feed
	 feed("night")
	 feedreset("night")

	 subprocess.call("sudo python /var/www/html/pycode/relayphase-check.py night", shell=True)
	 # print ("ITS NIGHT TIME")
	
	if now_time >= time(int(nolight_start_hour),int(nolight_start_min)) and now_time <= time(23,59,59):
	 # print "HERE1"
	 if debug == 1:
	 	print ("Base on NOW time using No Light")
	 curs.execute ('UPDATE sched SET phase="nolight" WHERE id="0"')
	 curs.execute ('UPDATE sched SET lastupdate=CURRENT_TIMESTAMP WHERE id="0"')
	 
	 if (nolight == 0):
	 	curs.execute ('INSERT INTO  alert SET collection="rss", category="Phase", title="Phase Change", message="Phase Just Changed To: No Light"')
	 db.commit()
	 sunrise = 0
	 morning = 0
	 daytime = 0
	 afternoon = 0
	 sunset = 0
	 night = 0
	 nolight = 1

	 # feed
	 feed("nolight")
	 feedreset("nolight")

	 subprocess.call("sudo python /var/www/html/pycode/relayphase-check.py nolight", shell=True)
	
	if now_time >= time(00,00) and now_time <= time(int(sunrise_start_hour),int(sunrise_start_min)):
	 # print "HERE2"
	 if debug == 1:
	 	print ("Base on NOW time using No Light") #REM
	 curs.execute ('UPDATE sched SET phase="nolight" WHERE id="0"')
	 curs.execute ('UPDATE sched SET lastupdate=CURRENT_TIMESTAMP WHERE id="0"')
	 
	 if (nolight == 0):
	  curs.execute ('INSERT INTO  alert SET collection="rss", category="Phase", title="Phase Change", message="Phase Just Changed To: No Light"')
	 db.commit()
	 sunrise = 0
	 morning = 0
	 daytime = 0
	 afternoon = 0
	 sunset = 0
	 night = 0
	 nolight = 1

	 # feed
	 feed("nolight")
	 feedreset("nolight")

	 subprocess.call("sudo python /var/www/html/pycode/relayphase-check.py nolight", shell=True)

	start = 2
	curs.close()
	del curs


x = 0
y = 0
while x == 0:
	# print "start"
	curs = db.cursor()
	curs.execute ('SELECT * FROM codes where code="lddreboot";')
	results = curs.fetchall()
	for row in results:
		lddreboot=row[2]
		# print lddreboot
		if lddreboot=='1':
			# print "Is 1"
			call (["sudo","systemctl","stop","ldd"])
			call (["sudo","pkill","-f","ldd.py"])
			call (["sudo","systemctl","start","ldd"])
			curs.execute ("UPDATE codes SET state=0 WHERE code='lddreboot';")
			db.commit()
	curs.execute ('SELECT * FROM admin where setting="feed";')
	results = curs.fetchall()
	for row in results:
		global feed
		feed=row[2]
		# print feed
	if feed == '1':
		# call (["ls","-l","-h"])
		call (["python","/var/www/html/pycode/feed-bysched.py","webfeedbutton"])
		curs.execute ('UPDATE admin SET value=0 WHERE setting="feed";')
		db.commit()
	y = y + 1
	# print y
	time.sleep(1)	
	if (y == 3):
		run_sched()
		# print "RUNNNN" #REM
		y = 0
