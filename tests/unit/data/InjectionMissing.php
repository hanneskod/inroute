<?php
namespace unit\data;

/**
 * @inroute
 */
class InjectionMissing
{
    /**
     * @param void $a Inject clause missing...
     */
    public function __construct($a)
    {
        echo $a;
    }
}
