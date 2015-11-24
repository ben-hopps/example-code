#!/usr/bin/env perl
use strict;
use warnings;

my $i = 'foo';
for($i = 0; $i <= 10; $i += 2) {
	print "$i * $i = ", $i * $i."\n";
}
print "\nback in the first scope, \$i is still $i\n";
