#!/usr/bin/env perl
use strict;
use warnings;
use threads;

sub threaded_task {
	threads->create(sub {
		my $thr_id = threads->self->tid;
		print "Starting thread $thr_id\n";
		sleep 2;
		print "Ending thread $thr_id\n";
		threads->detach(); #End thread.
	});
}

while (1)
{
	threaded_task();
	sleep 1;
}
