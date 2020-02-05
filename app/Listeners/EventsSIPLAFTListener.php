<?php

namespace App\Listeners;

use App\Events\EventsSIPLAFT;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventsSIPLAFTListener
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
     * @param  EventsSIPLAFT  $event
     * @return void
     */
    public function handle(EventsSIPLAFT $event)
    {
        $InsertRegister = DB::table('records')->insert($event->data);
    }
}
