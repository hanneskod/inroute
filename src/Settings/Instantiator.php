<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace inroute\Settings;

use ReflectionClass;

/**
 * Instantiate reflected class
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class Instantiator
{
    /**
     * @var ReflectionClass Reflected class to instantiate
     */
    private $class;

    /**
     * Load class
     *
     * @param  string $classname
     * @return void
     */
    public function load($classname)
    {
        $this->setReflectionClass(new ReflectionClass($classname));
    }

    /**
     * Set class to instantiate
     *
     * @param  ReflectionClass $class
     * @return void
     */
    public function setReflectionClass(ReflectionClass $class)
    {
        $this->class = $class;
    }

    /**
     * Get loaded reflection class
     *
     * @return ReflectionClass
     * @throws LogicException If reflected class is not loaded
     */
    public function getReflectionClass()
    {
        if (!isset($this->class)) {
            throw new LogicException("Reflected class not loaded");
        }
        return $this->class;
    }

    /**
     * Get number of required constructor parameters
     *
     * @return int
     */
    public function countConstructorArgs()
    {
        if ($constructor = $this->class->getConstructor()) {
            return $constructor->getNumberOfRequiredParameters();
        }
        return 0;
    }

    /**
     * Check if class is instantiable
     *
     * @return boolean
     */
    public function isInstantiable()
    {
        return $this->getReflectionClass()->isInstantiable();
    }

    /**
     * Check if class is instantiable without constructor parameters
     *
     * @return boolean
     */
    public function isInstantiableWithoutArgs()
    {
        return $this->isInstantiable() && !$this->countConstructorArgs();
    }

    /**
     * Create instance
     *
     * @param  array $args Optional constructor arguments
     * @return mixed Instance of reflected class
     * @throws LogicException If reflected class is not instantiable
     */
    public function instantiate(array $args = null)
    {
        if (!$this->isInstantiable()) {
            throw new LogicException("Reflected class is not instantiable");
        }

        $args = $args ?: [];

        if (count($args) < $this->countConstructorArgs()) {
            throw new LogicException("Unable to instantiate, too few constructor arguments");
        }

        return $this->getReflectionClass()->newInstanceArgs($args);
    }
}
