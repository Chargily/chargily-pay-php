<?php

namespace Chargily\ChargilyPay\Validation\Api;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class PriceCreateValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "product_id" => "required|min:1",
            "amount" => "required|numeric",
            "currency" => "required|min:3|max:3",
            "metadata" => "nullable|array",
        ];
    }
}
