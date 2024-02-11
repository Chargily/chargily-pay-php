<?php

namespace Chargily\ChargilyPay\Validation\Api;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class CustomerCreateValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:1',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|array',
            'address.country' => 'required|min:2|max:2',
            'address.state' => 'required|min:2',
            'address.address' => 'required|min:2',
            'metadata' => 'nullable|array',
        ];
    }
}
