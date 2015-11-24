#!/usr/bin/env perl
use strict;
use warnings;

sub get_name {
	return 'fred';
}

my %addresses = ( get_name(), '123 4th st.', );
print $addresses{'fred'}."\n";
