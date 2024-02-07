<?php

namespace Chargily\ChargilyPay\Relation;

use Chargily\ChargilyPay\Core\Abstracts\RelationAbstract;
use Chargily\ChargilyPay\Core\Interfaces\RelationInterface;
use Chargily\ChargilyPay\Elements\CheckoutElement;
use Chargily\ChargilyPay\Elements\PaginationElement;

final class CustomerHasManyCheckoutsRelation extends RelationAbstract implements RelationInterface
{
    /**
     * Get All Prices
     *
     * @return CheckoutElement
     */
    public function create(array $data): ?CheckoutElement
    {
        return $this->foreign->create([...$data, ...["customer_id" => $this->attributes['id']]]);
    }
}
