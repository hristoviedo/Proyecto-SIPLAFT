<?php

namespace App\Listeners;

use App\Events\EventsSiplaft;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventsSiplaftListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventsSiplaft  $event
     * @return void
     */
    public function handle(EventsSiplaft $event)
    {
        $insertRecord = DB::table('records')->insert($event->data);
        // dd($insertRecord);
    }
}
