<?php

/**
 * Cycles through each argument added
 * Based on Rails `cycle` method
 *
 * if last argument begins with ":"
 * then it will change the namespace
 * (allows multiple cycle calls within a loop)
 *
 * @param mixed $values infinite amount can be added
 * @return mixed
 * @author Baylor Rae'
 */
function cycle($first_value, $values = '*')
{
    // keeps up with all counters
    static $count = array();

    // get all arguments passed
    $values = func_get_args();

    // set the default name to use
    $name = 'default';

    // check if last items begins with ":"
    $last_item = end($values);
    if (substr($last_item, 0, 1) === ':') {

        // change the name to the new one
        $name = substr($last_item, 1);

        // remove the last item from the array
        array_pop($values);
    }

    // make sure counter starts at zero for the name
    if (!isset($count[$name]))
        $count[$name] = 0;

    // get the current item for its index
    $index = $count[$name] % count($values);

    // update the count and return the value
    $count[$name]++;
    return $values[$index];
}

?>