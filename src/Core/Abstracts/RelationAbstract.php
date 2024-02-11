<?php

namespace Chargily\ChargilyPay\Core\Abstracts;

use Chargily\ChargilyPay\Core\Interfaces\ApiClassesInterface;
use Chargily\ChargilyPay\Exceptions\RelationNotFound;

abstract class RelationAbstract
{
    /**
     * Constructor
     *
     * @param  object  $local
     * @param  object  $foreign
     */
    public function __construct(public ApiClassesInterface $local, public ApiClassesInterface $foreign, public array $attributes)
    {
    }

    /**
     * Call
     *
     * @return void
     */
    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }

        throw new RelationNotFound("Method ({$name}) not found in relation ".get_class($this).'::class');
    }
}
