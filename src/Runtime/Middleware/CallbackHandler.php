<?php

declare(strict_types = 1);

namespace inroutephp\inroute\Runtime\Middleware;

use inroutephp\inroute\Runtime\Exception\DispatchException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
* PSR-15 wrapper for callbacks generated by {@see Pipeline} during dispatch.
*
* @internal
*/
final class CallbackHandler implements RequestHandlerInterface
{
    /**
     * @var callable
     */
    private $handler;

    public function __construct(callable $handler)
    {
        $this->handler = $handler;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = ($this->handler)($request);

        if (!$response instanceof ResponseInterface) {
            throw new DispatchException(
                'Handler callable must return a ResponseInterface object. Found: ' . gettype($response)
            );
        }

        return $response;
    }
}