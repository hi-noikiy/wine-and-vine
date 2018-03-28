<?php

namespace App\Observers;

class RegionObserver extends AbstractObserver
{
    /**
     * Listen to the Region's retrieved event.
     *
     * @param Region $region
     * @return void
     */
    public function retrieved($region): void
    {
        // TODO: Implement retrieved() method.
    }

    /**
     * Listen to the Region's creating event.
     *
     * @param Region $region
     * @return void
     */
    public function creating($region): void
    {
        // TODO: Implement creating() method.
    }

    /**
     * Listen to the Region's created event.
     *
     * @param Region $region
     * @return void
     */
    public function created($region): void
    {
        $region->addMedia(config('wine-and-vine.data.images.default_path.regions_hero'))
            ->preservingOriginal()
            ->toMediaCollection('region_hero');
    }

    /**
     * Listen to the Region's updating event.
     *
     * @param Region $region
     * @return void
     */
    public function updating($region): void
    {
        // TODO: Implement updating() method.
    }

    /**
     * Listen to the Region's updated event.
     *
     * @param Region $region
     * @return void
     */
    public function updated($region): void
    {
        // TODO: Implement updated() method.
    }

    /**
     * Listen to the Region's saving event.
     *
     * @param Region $region
     * @return void
     */
    public function saving($region): void
    {
        // TODO: Implement saving() method.
    }

    /**
     * Listen to the Region's saved event.
     *
     * @param Region $region
     * @return void
     */
    public function saved($region): void
    {
        // TODO: Implement saved() method.
    }

    /**
     * Listen to the Region's deleting event.
     *
     * @param Region $region
     * @return void
     */
    public function deleting($region): void
    {
        // TODO: Implement deleting() method.
    }

    /**
     * Listen to the Region's deleted event.
     *
     * @param Region $region
     * @return void
     */
    public function deleted($region): void
    {
        // TODO: Implement deleted() method.
    }

    /**
     * Listen to the Region's restoring event.
     *
     * @param Region $region
     * @return void
     */
    public function restoring($region): void
    {
        // TODO: Implement restoring() method.
    }

    /**
     * Listen to the Region's restored event.
     *
     * @param Region $region
     * @return void
     */
    public function restored($region): void
    {
        // TODO: Implement restored() method.
    }
}
