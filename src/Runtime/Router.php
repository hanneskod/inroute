<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace inroute\Runtime;

/**
 * The inroute router
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class Router
{
    /**
     * @var Route[] Loaded routes
     */
    private $routes;

    /**
     * Constructor
     *
     * @param Route[] $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }
}
