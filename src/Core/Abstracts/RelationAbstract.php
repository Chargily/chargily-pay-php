<?php

namespace Chargily\ChargilyPay\Core\Abstracts;

use Chargily\ChargilyPay\Core\Interfaces\ApiClassesInterface;
use Chargily\ChargilyPay\Exceptions\RelationNotFound;
use ReflectionClass;

abstract class RelationAbstract
{
    /**
     * Constructor
     *
     * @param object $local
     * @param object $foreign
     * @param array $attributes
     */
    public function __construct(public ApiClassesInterface $local, public ApiClassesInterface $foreign, public array $attributes)
    {
    }
    /**
     * Call
     *
     * @param string $name
     * @param array $arguments
     * @return void
     */
    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }

        throw new RelationNotFound("Method ({$name}) not found in relation " . get_class($this) . "::class");
    }
}
