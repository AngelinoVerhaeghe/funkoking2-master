<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use App\Mail\UserSubscribedMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailOwerAboutSubscription
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

    //! Expecting a event here its UserSubscribed

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserSubscribed $event)
    {
        //! Save into the database
        DB::table('newsletter')->insert([
            'email' => $event->email,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //! Sent email to User that has subscribed
        Mail::to($event->email)->send(new UserSubscribedMessage);
    }
}
