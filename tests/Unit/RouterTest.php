<?php

namespace Tests\Unit;

use App\Container;
use App\Exceptions\RouteNotFoundException;
use App\Router;
use Tests\TestCase;

class RouterTest extends TestCase
{
    protected Router $router;

    protected function setUp(): void
    {
        parent::setUp();

        $this->router = new Router(new Container());
    }

    public function test_it_registers_a_get_route(): void
    {
        $this->router->get('/users', ['Users', 'index']);

        $expected = [
            'GET' => [
                '/users' => ['Users', 'index']
            ]
        ];

        $this->assertSame($expected, $this->router->toArray());
    }

    public function test_it_registers_a_post_route(): void
    {
        $this->router->post('/users', ['Users', 'store']);

        $expected = [
            'POST' => [
                '/users' => ['Users', 'store']
            ]
        ];

        $this->assertSame($expected, $this->router->toArray());
    }

    public function test_there_are_no_routes_when_router_is_created(): void
    {
        $this->assertEmpty((new Router(new Container))->toArray());
    }

    /**
     * @dataProvider \Tests\DataProviders\RouterDataProvider::routeNotFoundCases
     */
    public function test_it_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ): void {
        $this->expectException(RouteNotFoundException::class);

        $User = new class() {
            public function delete(): bool
            {
                return true;
            }
        };

        $this->router
            ->get('/users', [$User::class, 'index'])
            ->post('/users', ['Users', 'store']);

        $this->router->resolve($requestUri, $requestMethod);
    }

    public function test_it_resolves_route_from_a_closure(): void
    {
        $expected = [1, 2, 3, 4, 5];

        $this->router->get('/users', fn() => $expected);

        $this->assertSame(
            $expected,
            $this->router->resolve('/users', 'get')
        );
    }

    public function test_it_resolves_route(): void
    {
        $User = new class() {
            public function index(): array
            {
                return [1, 2, 3, 4, 5];
            }
        };

        $this->router->get('/users', [$User::class, 'index']);

        $this->assertSame(
            [1, 2, 3, 4, 5],
            $this->router->resolve('/users', 'get')
        );
    }
}
