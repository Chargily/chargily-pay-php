<?php

namespace Chargily\ChargilyPay\Relation;

use Chargily\ChargilyPay\Core\Abstracts\RelationAbstract;
use Chargily\ChargilyPay\Core\Interfaces\RelationInterface;
use Chargily\ChargilyPay\Elements\PaginationElement;

final class CheckoutHasManyPricesRelation extends RelationAbstract implements RelationInterface
{
    /**
     * Get All Prices
     *
     * @return PaginationElement
     */
    public function all($per_page = 10, $page = 1): ?PaginationElement
    {
        return $this->local->getItems($this->attributes['id'], $per_page, $page);
    }
}
