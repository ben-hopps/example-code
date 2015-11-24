#!/usr/bin/env perl
use warnings;
use strict;

sub context {
	my $context = wantarray();

	say defined $context
		? $context
			? 'list'
			: 'scalar'
		: 'void';
	return 0;
}
my @list_slice = (1, 2, 3)[context()];
my @array_slice = @list_slice[context()];
my $array_index = $array_slice[context()];
