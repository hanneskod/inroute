<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace inroute\classtools;

/**
 * Filter classes based ReflectionClass method
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class WhereFilter implements FilterInterface
{
    use FilterInterfaceTrait, FilterableTrait;

    private $methodName, $returnValue;

    public function __construct($methodName, $returnValue = true)
    {
        $this->methodName = $methodName;
        $this->returnValue = $returnValue;
    }

    public function getIterator()
    {
        $methodName = $this->methodName;
        foreach ($this->getFilterable() as $className => $reflectedClass) {
            if ($reflectedClass->$methodName() == $this->returnValue) {
                yield $className => $reflectedClass;
            }
        }
    }
}
