<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Winery;

class WineryObserver extends AbstractObserver
{
    /**
     * Listen to the Winery's retrieved event.
     *
     * @param Winery $winery
     * @return void
     */
    public function retrieved($winery): void
    {
        // TODO: Implement retrieved() method.
    }

    /**
     * Listen to the Winery's creating event.
     *
     * @param Winery $winery
     * @return void
     */
    public function creating($winery): void
    {
        // TODO: Implement creating() method.
    }

    /**
     * Listen to the Winery created event.
     *
     * @param Winery $winery
     * @return void
     */
    public function created($winery): void
    {
        $winery->addMedia(config('wine-and-vine.data.images.default_path.wineries'))
            ->preservingOriginal()
            ->toMediaCollection('cover');
    }

    /**
     * Listen to the Winery's updating event.
     *
     * @param Winery $winery
     * @return void
     */
    public function updating($winery): void
    {
    }

    /**
     * Listen to the Winery's updated event.
     *
     * @param Winery $winery
     * @return void
     */
    public function updated($winery): void
    {
    }

    /**
     * Listen to the Winery's saving event.
     *
     * @param Winery $winery
     * @return void
     */
    public function saving($winery): void
    {
        // TODO: Implement saving() method.
    }

    /**
     * Listen to the Winery's saved event.
     *
     * @param Winery $winery
     * @return void
     */
    public function saved($winery): void
    {
        // TODO: Implement saved() method.
    }

    /**
     * Listen to the Winery's deleting event.
     *
     * @param Winery $winery
     * @return void
     */
    public function deleting($winery): void
    {
        // TODO: Implement deleting() method.
    }

    /**
     * Listen to the Winery's deleted event.
     *
     * @param Winery $winery
     * @return void
     */
    public function deleted($winery): void
    {
        // TODO: Implement deleted() method.
    }

    /**
     * Listen to the Winery's restoring event.
     *
     * @param Winery $winery
     * @return void
     */
    public function restoring($winery): void
    {
        // TODO: Implement restoring() method.
    }

    /**
     * Listen to the Winery's restored event.
     *
     * @param Winery $winery
     * @return void
     */
    public function restored($winery): void
    {
        // TODO: Implement restored() method.
    }
}
