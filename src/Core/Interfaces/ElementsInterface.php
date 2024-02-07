<?php

namespace Chargily\ChargilyPay\Core\Interfaces;

interface ElementsInterface
{

    /**
     * Magic Call
     *
     * @param string $name
     * @param array $arguments
     */
    public function __call($name, $arguments);
    /**
     * All ATrributes
     */
    public  function all();
    /**
     * All Methods
     */
    public  function methods();
}
