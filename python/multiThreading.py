#!/usr/bin/python
'''
import thread
import time
def print_time( threadName, delay):
	count = 0
	while count < 5:
		time.sleep(delay)
		count += 1
		print "%s: %s" % ( threadName, time.ctime(time.time()) )

try:
	thread.start_new_thread( print_time, ("Thread-1", 2, ) )
	thread.start_new_thread( print_time, ("Thread-2", 4, ) )
except:
	print "error: unable to start thread"

while 1:
	pass
'''

import threading
import time

exitFlag = 0

class myThread (threading.Thread):
	def __init__(self, threadID, name, counter):
		threading.Thread.__init__(self)
		self.threadID = threadID
		self.name = name
		self.counter = counter
	def run(self):
		print "Starting " + self.name
		print_time(self.name, self.counter, 5)
		print "Exiting " + self.name

def print_time(threadName, delay, counter):
	while counter:
		if exitFlag:
			thread.exit()
		time.sleep(delay)
		print "%s: %s" % (threadName, time.ctime(time.time()))
		counter -= 1

thread1 = myThread(1, "Thread-1", 1)
thread2 = myThread(2, "Thread-2", 2)

thread1.start()
thread2.start()

print "Exiting Main Thread"
