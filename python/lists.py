#!/usr/bin/python
yorkie = 'Marlowe'
mutt = 'Kafka'

# Tuples
items = (1, mutt, 'Honda', (1,2,3))
'''
print items[1]
print items[-1]
items2 = items[0:2]

print 'Honda' in items
print len(items)
print items.index('Kafka')
'''
groceries = ['ham','spam','eggs']
print len(groceries)
print groceries[1]

for x in groceries:
	print x.upper()

groceries[2] = 'bacon'

groceries.append('eggs')
groceries[2:3] = "sammich"
print groceries
