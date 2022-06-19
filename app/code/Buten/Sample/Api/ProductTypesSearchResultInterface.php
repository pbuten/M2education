<?php

namespace Buten\Sample\Api;

use Magento\Framework\Data\SearchResultInterface;
use Buten\Sample\Api\Data\ProductTypesInterface;

interface ProductTypesSearchResultInterface extends SearchResultInterface
{
    /**
     * @return ProductTypesInterface[]
     */
    public function getItems();

    /**
     * @param ProductTypesInterface[]
     * @return void
     */
    public function setItems(array $items);
}
