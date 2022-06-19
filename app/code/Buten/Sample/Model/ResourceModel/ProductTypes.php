<?php


namespace Buten\Sample\Model\ResourceModel;


use Buten\Sample\Api\Data\ProductTypesInterface;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductTypes extends AbstractDb
{
    public const TABLE_NAME = 'buten_product_types';
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, ProductTypesInterface::ID);
    }
}
