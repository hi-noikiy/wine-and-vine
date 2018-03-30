<?php

namespace App\Observers;

use App\User;
use App\Winery;
use App\Address;

class AddressObserver extends AbstractObserver
{
    /**
     * Listen to the Address's retrieved event.
     *
     * @param Address $address
     * @return void
     */
    public function retrieved($address): void
    {
        // TODO: Implement retrieved() method.
    }

    /**
     * Listen to the Address's creating event.
     *
     * @param Address $address
     * @return void
     */
    public function creating($address): void
    {
        // TODO: Implement creating() method.
    }

    /**
     * Listen to the Address's created event.
     *
     * @param Address $address
     * @return void
     */
    public function created($address): void
    {
        // TODO: Implement created() method.
    }

    /**
     * Listen to the Address's updating event.
     *
     * @param Address $address
     * @return void
     */
    public function updating($address): void
    {
        // TODO: Implement updating() method.
    }

    /**
     * Listen to the Address's updated event.
     *
     * @param Address $address
     * @return void
     */
    public function updated($address): void
    {
        // TODO: Implement updated() method.
    }

    /**
     * Listen to the Address's saving event.
     *
     * @param Address $address
     * @return void
     */
    public function saving($address): void
    {
    }

    /**
     * Listen to the Address's saved event.
     *
     * @param Address $address
     * @return void
     */
    public function saved($address): void
    {
        if ($address->addressable_type === Winery::class) {
            $winery = Winery::find($address->addressable_id);
            if ($winery->region->country->id !== $address->country_id) {
                $address->update(['country_id' => $winery->region->country->id]);
            }
        }
    }

    /**
     * Listen to the Address's deleting event.
     *
     * @param Address $address
     * @return void
     */
    public function deleting($address): void
    {
        // TODO: Implement deleting() method.
    }

    /**
     * Listen to the Address's deleted event.
     *
     * @param Address $address
     * @return void
     */
    public function deleted($address): void
    {
        // TODO: Implement deleted() method.
    }

    /**
     * Listen to the Address's restoring event.
     *
     * @param Address $address
     * @return void
     */
    public function restoring($address): void
    {
        // TODO: Implement restoring() method.
    }

    /**
     * Listen to the Address's restored event.
     *
     * @param Address $address
     * @return void
     */
    public function restored($address): void
    {
        // TODO: Implement restored() method.
    }
}
