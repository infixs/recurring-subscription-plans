<?php
use Infixs\Collections\Collection;


if (! function_exists('collect')) {
    /**
     * Create a collection from the given value.
     *
     * @param  mixed  $value
     * @return \Infixs\Collections\Collection
     */
    function collect($value = null)
    {
        return new Collection($value);
    }
}
