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
}
