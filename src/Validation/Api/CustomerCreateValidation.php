<?php

namespace Chargily\ChargilyPay\Validation\Api;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class CustomerCreateValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => "required|min:1",
            "email" => "required|email",
            "phone" => "required|numeric",
            "address" => "nullable|array",
            "address.country" => "nullable|min:2|max:2",
            "address.state" => "nullable|min:2",
            "address.address" => "nullable|min:2",
            "metadata" => "nullable|array",
        ];
    }
}
