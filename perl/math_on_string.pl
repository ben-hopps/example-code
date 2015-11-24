#!/usr/bin/env perl
use strict;
use warnings;

my $call_sign = 'KBMIU';

# Update sign in place and return new value
my $next_sign = ++$call_sign;
print $next_sign."\n";


# Return old value, then update sign
my $curr_sign = $call_sign++;

# but does not work as:
my $new_sign = $call_sign + 1;
