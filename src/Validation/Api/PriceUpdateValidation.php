<?php

namespace Chargily\ChargilyPay\Validation\Api;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class PriceUpdateValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "product_id" => "nullable|min:1",
            "amount" => "nullable|numeric",
            "currency" => "nullable|min:3|max:3",
            "metadata" => "nullable|array",
        ];
    }
}
