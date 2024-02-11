<?php

namespace Chargily\ChargilyPay\Core\Abstracts;

use Chargily\ChargilyPay\Core\Helpers\Validator;

abstract class Validation
{
    /**
     * Undocumented variable
     */
    protected ?object $validation;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $validator = new Validator();
        $validation = $validator->make($data, $this->rules());

        $validation->validate();

        $this->validation = $validation;
    }

    /**
     * Rules
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Errors
     */
    public function errors(): array
    {
        return ($this->validation) ? $this->validation->errors()->firstOfAll() : [];
    }

    /**
     * Errors
     */
    public function passed(): bool
    {
        return ($this->validation) ? ! $this->validation->fails() : true;
    }
}
