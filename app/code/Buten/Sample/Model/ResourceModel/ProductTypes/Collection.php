<?php

namespace Buten\Sample\Model\ResourceModel\ProductTypes;

use Buten\Sample\Model\ProductTypes;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Buten\Sample\Model\ResourceModel\ProductTypes as ProductTypesResource;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(ProductTypes::class, ProductTypesResource::class);
    }

}
