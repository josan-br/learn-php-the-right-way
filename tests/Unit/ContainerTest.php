<?php

namespace Tests\Unit;

use App\Container;
use App\Exceptions\ContainerException;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    private Container $container;

    protected function setUp(): void
    {
        parent::setUp();
        $this->container = new Container();
    }

    public function test_has_returns_false_when_entry_not_registered(): void
    {
        $this->assertFalse($this->container->has(SomeService::class));
    }

    public function test_has_returns_true_when_entry_is_registered(): void
    {
        $this->container->set(SomeService::class, SomeService::class);

        $this->assertTrue($this->container->has(SomeService::class));
    }

    public function test_get_returns_registered_entry(): void
    {
        $service = new SomeService();
        $this->container->set(SomeService::class, fn() => $service);

        $result = $this->container->get(SomeService::class);

        $this->assertSame($service, $result);
    }

    public function test_resolve_returns_new_instance_for_class_without_dependencies(): void
    {
        $result = $this->container->get(SomeService::class);

        $this->assertInstanceOf(SomeService::class, $result);
    }

    public function test_resolve_injects_dependencies(): void
    {
        $result = $this->container->get(ServiceWithDependency::class);

        $this->assertInstanceOf(ServiceWithDependency::class, $result);
        $this->assertInstanceOf(SomeService::class, $result->dependency);
    }

    public function test_resolve_recursive_dependencies(): void
    {
        $result = $this->container->get(DeepNestedService::class);

        $this->assertInstanceOf(DeepNestedService::class, $result);
        $this->assertInstanceOf(ServiceWithDependency::class, $result->middle);
        $this->assertInstanceOf(SomeService::class, $result->middle->dependency);
    }

    public function test_throws_exception_for_non_instantiable_class(): void
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionMessage("is not instantiable");

        $this->container->get(AbstractService::class);
    }

    public function test_throws_exception_for_param_without_type_hint(): void
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionMessage("param 'param' is missing a type hint");

        $this->container->get(ServiceWithUntypedParam::class);
    }

    public function test_throws_exception_for_union_type_param(): void
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionMessage("of union type for param 'param'");

        $this->container->get(ServiceWithUnionType::class);
    }

    public function test_throws_exception_for_builtin_type_param(): void
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionMessage("invalid param 'param'");

        $this->container->get(ServiceWithBuiltinType::class);
    }
}

class SomeService {}

abstract class AbstractService {
    public static function getInstance(): self {
        return new static();
    }
}

class ServiceWithDependency {
    public SomeService $dependency;

    public function __construct(SomeService $dependency)
    {
        $this->dependency = $dependency;
    }
}

class MiddleService {
    public SomeService $dependency;

    public function __construct(SomeService $dependency)
    {
        $this->dependency = $dependency;
    }
}

class DeepNestedService {
    public ServiceWithDependency $middle;

    public function __construct(ServiceWithDependency $middle)
    {
        $this->middle = $middle;
    }
}

class ServiceWithUntypedParam {
    public function __construct($param) {}
}

class ServiceWithBuiltinType {
    public function __construct(int $param) {}
}

class ServiceA {}
class ServiceB {}

class ServiceWithUnionType {
    public function __construct(ServiceA|ServiceB $param) {}
}
