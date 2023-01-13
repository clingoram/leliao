<?php

namespace App\Listeners;

use App\Events\MessagePublic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPublicMessage
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
     * @param  \App\Events\MessagePublic  $event
     * @return void
     */
    public function handle(MessagePublic $event)
    {
        //
    }
}
