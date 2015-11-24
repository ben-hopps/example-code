#!/usr/bin/perl
use strict;
use warnings;

my $foo = 'baz';
my $bar = 'bat';
$bar ||= $foo;
print "$bar\n";
