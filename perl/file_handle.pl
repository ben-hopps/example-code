#!/usr/bin/env perl
use strict;
use warnings;

use autodie 'open';
open my $fh, '<', 'in_file';

while( <$fh> ) {
	print $_;
}
