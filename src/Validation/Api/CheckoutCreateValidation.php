<?php

namespace Chargily\ChargilyPay\Validation\Api;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class CheckoutCreateValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     */
    public function rules(): array
    {
        return [
            'success_url' => 'required|url',
            'customer_id' => 'nullable|min:1',
            'failure_url' => 'nullable|url',
            'webhook_endpoint' => 'nullable|url',
            'description' => 'nullable|min:1',
            'locale' => 'nullable|min:2|max:2',
            'metadata' => 'nullable|array',
        ];
    }
}
