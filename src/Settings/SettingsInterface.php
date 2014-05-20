<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace inroute\Settings;

/**
 * Defines compile time settings for inroute project
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
interface SettingsInterface
{
    /**
     * Get path to prepend to all routes
     *
     * @return string
     */
    public function getRootPath();

    /**
     * Get array of plugin objects to load att compile time
     *
     * @return \inroute\Plugin\PluginInterface[]
     */
    public function getPlugins();
}
