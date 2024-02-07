<?php

namespace Chargily\ChargilyPay\Core\Interfaces;

interface RelationInterface
{
    /**
     * Constructor
     *
     */
    public function __construct(ApiClassesInterface $local, ApiClassesInterface $foreign, array $attributes);
}
