<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Wine;

class WineObserver extends AbstractObserver
{
    /**
     * Listen to the Wine's retrieved event.
     *
     * @param Wine $wine
     * @return void
     */
    public function retrieved($wine): void
    {
        // TODO: Implement retrieved() method.
    }

    /**
     * Listen to the Wine's creating event.
     *
     * @param Wine $wine
     * @return void
     */
    public function creating($wine): void
    {
        // TODO: Implement creating() method.
    }

    /**
     * Listen to the Wine's created event.
     *
     * @param Wine $wine
     * @return void
     */
    public function created($wine): void
    {
        $wine->addMedia(config('wine-and-vine.data.images.default_path.wines'))
            ->preservingOriginal()
            ->toMediaCollection('cover');
    }

    /**
     * Listen to the Wine's updating event.
     *
     * @param Wine $wine
     * @return void
     */
    public function updating($wine): void
    {
        // TODO: Implement updating() method.
    }

    /**
     * Listen to the Wine's updated event.
     *
     * @param Wine $wine
     * @return void
     */
    public function updated($wine): void
    {
        // TODO: Implement updated() method.
    }

    /**
     * Listen to the Wine's saving event.
     *
     * @param Wine $wine
     * @return void
     */
    public function saving($wine): void
    {
        // TODO: Implement saving() method.
    }

    /**
     * Listen to the Wine's saved event.
     *
     * @param Wine $wine
     * @return void
     */
    public function saved($wine): void
    {
        // TODO: Implement saved() method.
    }

    /**
     * Listen to the Wine's deleting event.
     *
     * @param Wine $wine
     * @return void
     */
    public function deleting($wine): void
    {
        // TODO: Implement deleting() method.
    }

    /**
     * Listen to the Wine's deleted event.
     *
     * @param Wine $wine
     * @return void
     */
    public function deleted($wine): void
    {
        // TODO: Implement deleted() method.
    }

    /**
     * Listen to the Wine's restoring event.
     *
     * @param Wine $wine
     * @return void
     */
    public function restoring($wine): void
    {
        // TODO: Implement restoring() method.
    }

    /**
     * Listen to the Wine's restored event.
     *
     * @param Wine $wine
     * @return void
     */
    public function restored($wine): void
    {
        // TODO: Implement restored() method.
    }
}
