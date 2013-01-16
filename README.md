inroute
=======

DI container and router wrapper for powerful and easy REST development with PHP


## Simple inroute.json

    {
        "container": "\\project\\DIContainer",
        "dirs": "src"
    }

## Inline invokction

    <?php

    include "vendor/autoload.php";

    $facade = new \itbz\inroute\InrouteFacade('inroute.json');
    $inroute = eval($facade->generate());

    echo $inroute->dispatch('/foo/yeah', $_SERVER);

## Controller

    <?php
    namespace itbz\test;
    use itbz\inroute\Route;

    /**
     * @inroute
     */
    class Working
    {
        /**
         * @inject $x xfactory
         * @inject $bar foobar
         * @inject $y xx
         */
        public function __construct(\DateTime $bar, array $x, $y = 'optional')
        {
        }

        /**
         * @route GET /foo/{:name}
         */
        public function foo(Route $route)
        {
            return 'Working::foo';
        }

        /**
         * @route POST /bar/{:name}
         */
        public function bar(Route $route)
        {
            var_dump($route);
        }
    }

## DI-container

    <?php
    namespace itbz\test;

    class Container extends \Pimple
    {
        public function __construct()
        {
            $this['foobar'] = function ($c) {
                return new \DateTime;
            };
            $this['xfactory'] = function ($c) {
                return array();
            };
            $this['xx'] = function ($c) {
                return 'xx';
            };
        }
    }
