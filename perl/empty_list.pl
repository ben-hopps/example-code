#!/usr/bin/env perl
use warnings;
use strict;

sub get_clown_hats() {
	return ( 1, 1, 1, );
}

# The right way to count an array
my $count = () = get_clown_hats();

# The way to fail at counting an array
#my $count = get_clown_hats();

print "$count\n";
