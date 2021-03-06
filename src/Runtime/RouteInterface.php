<?php

namespace inroutephp\inroute\Runtime;

interface RouteInterface
{
    /**
     * Get name of this route
     */
    public function getName(): string;

    /**
     * Create a new route with name
     */
    public function withName(string $name): RouteInterface;

    /**
     * Check if this route is routable
     */
    public function isRoutable(): bool;

    /**
     * Create a new route with routable setting
     */
    public function withRoutable(bool $routable): RouteInterface;

    /**
     * Get list of http methods to route on
     *
     * @return string[] Loaded http methods in UPPER CASE
     */
    public function getHttpMethods(): array;

    /**
     * Create a new route with added http method
     *
     * Note that http method is case insensitive
     */
    public function withHttpMethod(string $httpMethod): RouteInterface;

    /**
     * Create a new route with removed http method
     *
     * Note that http method is case insensitive
     */
    public function withoutHttpMethod(string $httpMethod): RouteInterface;

    /**
     * Get route path
     */
    public function getPath(): string;

    /**
     * Create a new route with path
     */
    public function withPath(string $path): RouteInterface;

    /**
     * Check if route has attribute
     */
    public function hasAttribute(string $name): bool;

    /**
     * Get route attribute
     *
     * @return mixed
     */
    public function getAttribute(string $name);

    /**
     * Get all loaded route attributes
     *
     * @return array<string, mixed>
     */
    public function getAttributes(): array;

    /**
     * Create a new route with attribute
     *
     * @param  string $name
     * @param  mixed  $value
     */
    public function withAttribute(string $name, $value): RouteInterface;

    /**
     * Get id of service used when dispatching route
     */
    public function getServiceId(): string;

    /**
     * Create a new route with service id
     */
    public function withServiceId(string $serviceId): RouteInterface;

    /**
     * Get name of method used when dispatching route
     */
    public function getServiceMethod(): string;

    /**
     * Create a new route with dispatch method
     */
    public function withServiceMethod(string $serviceMethod): RouteInterface;

    /**
     * Get service ids of psr-15 middleware to pipe on route dispatch
     *
     * @return string[]
     */
    public function getMiddlewareServiceIds(): array;

    /**
     * Create a new route with piped in middleware with service id
     */
    public function withMiddleware(string $serviceId): RouteInterface;

    /**
     * Check if annotation is present
     */
    public function hasAnnotation(string $annotationId): bool;

    /**
     * Get first instance of annotation id
     */
    public function getAnnotation(string $annotationId): ?object;

    /**
     * Get set of annotations, possibly filtered by id
     *
     * @return array<object>
     */
    public function getAnnotations(string $annotationId = ''): array;
}
