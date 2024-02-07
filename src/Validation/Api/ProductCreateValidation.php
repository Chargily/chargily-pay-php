<?php

namespace Chargily\ChargilyPay\Validation\Api;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class ProductCreateValidation extends Validation implements ValidationInterface
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
            "description" => "nullable|min:1",
            "images" => "nullable|array",
            "metadata" => "nullable|array",
        ];
    }
}
