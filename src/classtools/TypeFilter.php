<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace inroute\classtools;

use ReflectionException;

/**
 * Filter classes of a spefcified type
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class TypeFilter implements FilterInterface
{
    use FilterInterfaceTrait, FilterableTrait;

    private $typename;

    public function __construct($typename)
    {
        $this->typename = $typename;
    }

    public function getIterator()
    {
        foreach ($this->getFilterable() as $className => $reflectedClass) {
            try {
                if ($reflectedClass->implementsInterface($this->typename)) {
                    yield $className => $reflectedClass;
                }
            } catch (ReflectionException $e) {
                try {
                    if (
                        $reflectedClass->isSubclassOf($this->typename)
                        || $reflectedClass->getName() == $this->typename
                    ) {
                        yield $className => $reflectedClass;
                    }
                } catch (ReflectionException $e) {
                    // Nope
                }
            }
        }
    }
}
