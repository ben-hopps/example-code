#!/usr/bin/env perl
use warnings;
use strict;

package Store::Toy {
	sub discount {
		my $foo = 1;
		print "$foo\n";
	}
}
print Store::Toy->discount;
