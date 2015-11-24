#!/usr/bin/env perl
use strict;
use warnings;

use Data::Dumper;
use Getopt::Long qw( :config pass_through );

my %opts;
my %cpts;

GetOptions(\%opts, 'verbose|v', 'really|r', 'update' );


if( $opts{'update'} ){
	# command specific option processing
	GetOptions(\%cpts, 'name=s', 'status=s' );

	die "You need to provide a name option?!" unless( $cpts{'name'} );
	die "You need to provide a status option!" unless( $cpts{'status'} );

	my $id = shift || die "you need to provide an ID!";

	print join ' ', ( $id, $cpts{'name'}, $cpts{'status'} );
}


# COMMAND [OPTIONS] --update [OPTIONS] ID

