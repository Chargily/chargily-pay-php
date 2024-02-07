<?php

namespace Chargily\ChargilyPay\Elements;

use Chargily\ChargilyPay\Core\Interfaces\ElementsInterface;
use Chargily\ChargilyPay\Core\Abstracts\ElementsAbstract;
use Chargily\ChargilyPay\Core\Helpers\Collection;

/**
 * @method \Chargily\ChargilyPay\Elements\PaginationElement getCurrentPage()
 * @method \Chargily\ChargilyPay\Elements\PaginationElement getFirstPage()
 * @method \Chargily\ChargilyPay\Elements\PaginationElement getLastPage()
 * @method \Chargily\ChargilyPay\Elements\PaginationElement getPerPage()
 * @method \Chargily\ChargilyPay\Elements\PaginationElement getTotal()
 * @method \Chargily\ChargilyPay\Elements\PaginationElement getData()
 */
class PaginationElement extends ElementsAbstract implements ElementsInterface
{
    /**
     * Constructor
     *
     * @param array $configs
     * @param array|Collection $data
     */
    public function __construct(array $configs, array|Collection $data)
    {
        $this->setCurrentPage($configs["current_page"]);
        $this->setFirstPage(1);
        $this->setLastPage($configs["last_page"]);
        $this->setPerPage($configs["per_page"]);
        $this->setTotal($configs["total"]);
        $this->setData($data);
    }
}
