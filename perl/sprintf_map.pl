#!/usr/bin/env perl

use strict;
use warnings;
use Data::Dumper;
=c
my $var = 100;
my $line = sprintf( "a%-5sa", $var );
print $line."\n";
=cut

my %vars;
%vars = ( 'a' => 'foo', 'b' => 'bar' );

# Use this hash syntax on the dynect vm...w/e perl version that is
#my $line = sprintf( "0000a%-10s0000%-5s0000", ( map { $vars->{ $_ } }

# and this one on my workstation
my $line = sprintf( "0000a%-10s0000%-5s0000", ( map { %vars->{ $_ } }
		qw( a b ) ) );
print $line."\n";
