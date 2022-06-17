<?php


namespace Buten\Sample\Model;


use Buten\Sample\Api\Data\ProductTypesInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class ProductTypes
 * @package Buten\Sample\Model
 */
class ProductTypes extends AbstractModel implements ProductTypesInterface
{
    protected function _construct()
    {
        parent::_init('Buten\Sample\Model\ResourceModel\ProductTypes');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->getData(ProductTypesInterface::TYPE);
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->setData(ProductTypesInterface::TYPE, $type);
    }

    public function getId()
    {
        return $this->_getData('entity_id');
    }

    public function setId($value)
    {
        return $this->setData('entity_id', $value);
    }
}
