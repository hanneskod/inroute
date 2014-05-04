<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace inroute\Compiler;

use IteratorAggregate;
use hanneskod\classtools\FilterableClassIterator;
use Psr\Log\LoggerInterface;
use inroute\PluginInterface;
use inroute\Exception\CompilerSkipRouteException;

/**
 * Create route definitions from controller classes
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class DefinitionFactory implements IteratorAggregate
{
    private $classIterator, $plugin, $logger;

    /**
     * @param FilterableClassIterator $classIterator
     * @param PluginInterface         $plugin
     * @param LoggerInterface         $logger
     */
    public function __construct(FilterableClassIterator $classIterator, PluginInterface $plugin, LoggerInterface $logger)
    {
        $this->classIterator = $classIterator->filterType('inroute\ControllerInterface');
        $this->plugin = $plugin;
        $this->logger = $logger;
    }

    /**
     * @return \Iterator
     */
    public function getIterator()
    {
        foreach ($this->classIterator as $classname => $reflectedClass) {
            $this->logger->info("Reading routes from $classname");
            /** @var Definition $definition */
            foreach (new DefinitionIterator($reflectedClass) as $definition) {
                try {
                    $this->plugin->processDefinition($definition);
                    $this->logger->info("Found route {$definition->read('controllerMethod')}", $definition->toArray());
                    yield $definition;
                } catch (CompilerSkipRouteException $e) {
                    $this->logger->debug("Skipped route {$definition->read('controllerMethod')}");
                }
            }
        }
    }
}
