<?php

/**
 * Creates an instance of the given $class with the given $attributes or a collection of $class objects if the $times
 * variable is overridden and persists the object or objects to the database.
 *
 * @param string $class
 * @param array $attributes
 * @param int|null $times
 * @return mixed
 */
function create(string $class, array $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

/**
 * Creates an instance of the given $class with the given $attributes or a collection of $class objects if the $times
 * variable is overridden.
 *
 * @param string $class
 * @param array $attributes
 * @param int|null $times
 * @return mixed
 */
function make(string $class, array $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}
