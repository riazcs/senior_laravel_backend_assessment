<?php

namespace App\Listeners;

use App\Events\UserSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserSavedListener implements ShouldQueue
{
    public function handle(UserSaved $event)
    {
        $user = $event->user;
        $addresses = request()->input('addresses', []);

        foreach ($addresses as $addressData) {
            $address = new Address($addressData);
            $user->addresses()->save($address);
        }
    }
}
