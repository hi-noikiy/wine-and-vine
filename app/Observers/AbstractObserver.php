<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractObserver
{
    /**
     * @param string $tags
     */
    protected function clearCacheTags(string $tags)
    {
        Cache::tags($tags)->flush();
    }

    /**
     * @param string $section
     */
    protected function clearCacheSections(string $section)
    {
        Cache::section($section)->flush();
    }

    /**
     * Listen to the Model retrieved event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function retrieved($model): void;

    /**
     * Listen to the Model creating event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function creating($model): void;

    /**
     * Listen to the Model created event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function created($model): void;

    /**
     * Listen to the Model updating event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function updating($model): void;

    /**
     * Listen to the Model updated event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function updated($model): void;

    /**
     * Listen to the Model saving event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function saving($model): void;

    /**
     * Listen to the Model saved event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function saved($model): void;

    /**
     * Listen to the Model deleting event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function deleting($model): void;

    /**
     * Listen to the Model deleted event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function deleted($model): void;

    /**
     * Listen to the Model restoring event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function restoring($model): void;

    /**
     * Listen to the Model restored event.
     *
     * @param Model $model
     * @return void
     */
    abstract public function restored($model): void;
}
