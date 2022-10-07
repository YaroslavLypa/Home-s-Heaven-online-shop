<?php


declare(strict_types=1);

namespace YaroslavLypa\HomesHaven;

use Illuminate\Support\Collection;

class Router
{
    /**
     * Array of routes
     *
     * @var Collection<string, callable>
     */
    private Collection $routes;

    public function __construct()
    {
        $this->routes = new Collection();
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        $matchedRoutes = $this->routes->where('path', $uri);
        if ($matchedRoutes->isEmpty()) {
            self::respondWithNotFound();
        }

        $route = $matchedRoutes->where('method', $method)->first();
        if ($route) {
            call_user_func($route['action']);
            return;
        }

        self::respondWithNotFound();
    }

    /**
     * @param string $path
     * @param callable $action
     * @return Router
     */
    public function get(string $path, callable $action): Router
    {
        $this->addRoute($path, 'get', $action);

        return $this;
    }

    /**
     * @param string $path
     * @param callable $action
     * @return Router
     */
    public function post(string $path, callable $action): Router
    {
        $this->addRoute($path, 'post', $action);

        return $this;
    }

    /**
     * @return void
     */
    public static function respondWithNotFound(): void
    {
        http_response_code(404);
        die();
    }

    /**
     * @param string $path
     * @param string $method
     * @param callable $action
     * @return void
     */
    private function addRoute(string $path, string $method, callable $action): void
    {
        $this->routes[] = compact('path', 'method', 'action');
    }
}