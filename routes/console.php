<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Schedule::command('plans:sync')->daily();
Schedule::command('sync:daily-stats')->daily();
Schedule::command('send:retention-email')->daily();
Schedule::command('send:registered-users-list-email')->dailyAt('00:02');