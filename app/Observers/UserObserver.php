<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\User;

class UserObserver extends AbstractObserver
{
    /**
     * Listen to the User's retrieved event.
     *
     * @param User $user
     * @return void
     */
    public function retrieved($user): void
    {
        \Log::info('retrieved');
    }

    /**
     * Listen to the User's creating event.
     *
     * @param User $user
     * @return void
     */
    public function creating($user): void
    {
        \Log::info('creating');
    }

    /**
     * Listen to the User's created event.
     *
     * @param User $user
     * @return void
     */
    public function created($user): void
    {
        $user->addMedia(config('wine-and-vine.data.images.default_path.users'))
            ->preservingOriginal()
            ->toMediaCollection('avatar');
    }

    /**
     * Listen to the User's's updating event.
     *
     * @param User $user
     * @return void
     */
    public function updating($user): void
    {
        \Log::info('updating');
    }

    /**
     * Listen to the User's updated event.
     *
     * @param User $user
     * @return void
     */
    public function updated($user): void
    {
        \Log::info('updated');
    }

    /**
     * Listen to the User's saving event.
     *
     * @param User $user
     * @return void
     */
    public function saving($user): void
    {
        \Log::info('saving');
    }

    /**
     * Listen to the User's saved event.
     *
     * @param User $user
     * @return void
     */
    public function saved($user): void
    {
        \Log::info('saved');
    }

    /**
     * Listen to the User's deleting event.
     *
     * @param User $user
     * @return void
     */
    public function deleting($user): void
    {
        \Log::info('deleting');
    }

    /**
     * Listen to the User's deleted event.
     *
     * @param User $user
     * @return void
     */
    public function deleted($user): void
    {
        \Log::info('deleted');
    }

    /**
     * Listen to the User's restoring event.
     *
     * @param User $user
     * @return void
     */
    public function restoring($user): void
    {
        \Log::info('restoring');
    }

    /**
     * Listen to the User's restored event.
     *
     * @param User $user
     * @return void
     */
    public function restored($user): void
    {
        \Log::info('restored');
    }
}
