<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Models\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserSavedListener implements ShouldQueue
{
    public function handle(UserSaved $event)
    {
        $user = $event->user;
        $addresses = request()->input('addresses', []);
        
        foreach ($addresses as $address) {
            $addressData = [
                'user_id' => $user->id,
                'address' => $address,
            ];
            $address = new Address($addressData);
            $user->addresses()->save($address);
        }
    }
}
