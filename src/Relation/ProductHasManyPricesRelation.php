<?php

namespace Chargily\ChargilyPay\Relation;

use Chargily\ChargilyPay\Core\Abstracts\RelationAbstract;
use Chargily\ChargilyPay\Core\Interfaces\RelationInterface;
use Chargily\ChargilyPay\Elements\PaginationElement;
use Chargily\ChargilyPay\Elements\PriceElement;

final class ProductHasManyPricesRelation extends RelationAbstract implements RelationInterface
{
    /**
     * Create new API
     *
     * @param array $data
     * @return 
     */
    public function create(array $data): ?PriceElement
    {
        return $this->foreign->create([...$data, ...["product_id" => $this->attributes['id']]]);
    }
    /**
     * Get Prices
     *
     * @return PaginationElement
     */
    public function get($per_page = 10, $page = 1): ?PaginationElement
    {
        return $this->local->prices($this->attributes['id'], $per_page, $page);
    }
}
