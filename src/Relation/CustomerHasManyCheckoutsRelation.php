<?php

namespace Chargily\ChargilyPay\Relation;

use Chargily\ChargilyPay\Core\Abstracts\RelationAbstract;
use Chargily\ChargilyPay\Core\Interfaces\RelationInterface;
use Chargily\ChargilyPay\Elements\CheckoutElement;

final class CustomerHasManyCheckoutsRelation extends RelationAbstract implements RelationInterface
{
    /**
     * Get All Prices
     */
    public function create(array $data): ?CheckoutElement
    {
        return $this->foreign->create([...$data, ...['customer_id' => $this->attributes['id']]]);
    }
}
