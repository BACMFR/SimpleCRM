<?php

namespace App\Listeners;

use App\Events\InteractionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendInteractionNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\InteractionCreated  $event
     * @return void
     */
    public function handle(InteractionCreated $event)
    {
        Log::info('New interaction created: ', ['interaction' => $event->interaction]);
    }
}
