<?php

namespace Chargily\ChargilyPay\Core\Interfaces;

interface ValidationInterface
{
    /**
     * Rules
     */
    public function rules(): array;

    /**
     * Errors
     */
    public function errors(): array;

    /**
     * Errors
     *
     * @return array
     */
    public function passed(): bool;
}
