<?php

namespace Chargily\ChargilyPay\Validation\Api;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class ProductUpdateValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => "nullable|min:1",
            "description" => "nullable|min:1",
            "images" => "nullable|array",
            "metadata" => "nullable|array",
        ];
    }
}
