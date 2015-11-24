#!/usr/bin/python

words = ['foo', 'bar', 'bat']
i = 0
for idx,word in enumerate(words):
	if idx == 1 :
		continue
	print(word, len(word))
