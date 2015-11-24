#!/usr/bin/perl
use Data::Dumper;
use Debug::Client;
#from http://learnxinyminutes.com/docs/perl/
my $animal = "camel";
my $answer = 42;


my @animals = ("camel", "llama", "owl");
my @numbers = (23, 42, 69);
my @mixed = ("camel", 42, 1.23);

my %fruit_color1 = ("apple", "red", "banana", "yellow");
my %fruit_color2 = (
	apple => "green",
	banana => "brown",
	);
#print Dumpeir(%fruit_color1);
#$d = Data::Dumper->new([$animal, $answer]);
#$d = Data::Dumper->new([$animal, $answer], [qw(animal *dump1)]);
#$d = Data::Dumper->new([%fruit_color2], [qw(fruit_color2 *)]);
#print $d->Dump;
