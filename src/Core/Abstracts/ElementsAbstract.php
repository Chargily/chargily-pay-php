<?php

namespace Chargily\ChargilyPay\Core\Abstracts;

use Chargily\ChargilyPay\Core\Helpers\Str;

abstract class ElementsAbstract
{
    /**
     * Attributes
     *
     * @var array
     */
    protected array $attributes = [];
    /**
     * Methods
     *
     * @var array
     */
    protected array $methods = [];

    /**
     * Magic Call
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (Str::startsWith($name, "set")) {
            $attribute_name = Str::snake(Str::substr($name, 3, 200));
            $this->attributes[$attribute_name] = ($arguments[0] ?? null);
            return $this;
        }
        if (Str::startsWith($name, "get")) {
            $attribute_name = Str::snake(Str::substr($name, 3, 200));
            return $this->attributes[$attribute_name] ?? null;
        }
        if (Str::startsWith($name, "attachMethod")) {
            $method_name = Str::snake(Str::substr($name, 12, 200));
            $callback = $arguments[0];
            $this->methods[$method_name] = $callback;
            return $this;
        }
        $method_name = Str::snake($name);
        if (isset($this->methods[$method_name])) {
            $callback = $this->methods[$method_name];
            if (is_callable($callback)) {
                return call_user_func_array($callback, $arguments);
            }
            return $callback;
        }
        return null;
    }
    /**
     * All
     *
     * @return array
     */
    public function all()
    {
        return $this->attributes;
    }
    /**
     * All Methods
     *
     * @return array
     */
    public function methods()
    {
        return $this->methods;
    }
    /**
     * Attributes To arrray
     *
     * @return string|null
     */
    public function toArray()
    {
        return $this->all();
    }
    /**
     * Attributes To json
     *
     * @return string|null
     */
    public function toJson(): ?string
    {
        return json_encode($this->toArray()) ?? null;
    }
}
