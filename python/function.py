#!/usr/bin/python

a = 'foo'
def toBeOrNotToBe(a):
	if a:
		print(a, "is")
		print(not a, "is not")

toBeOrNotToBe(a)
