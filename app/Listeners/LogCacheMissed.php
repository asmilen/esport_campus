<?php

namespace App\Listeners;

use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogCacheMissed
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
     * @param  CacheMissed  $event
     * @return void
     */
    public function handle(CacheMissed $event)
    {
        //
        
        if (str_contains($event->key, 'start_exam')) {
            # code...
        }
    }
}
