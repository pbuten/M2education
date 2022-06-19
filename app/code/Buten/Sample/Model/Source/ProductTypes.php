<?php

namespace Buten\Sample\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Buten\Sample\Model\ResourceModel\ProductTypes\Collection;

class ProductTypes extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    private Collection $collection;

    /** @var array */
    private $options;


    public function __construct(
        Collection $collection
    ){
        $this->collection = $collection;
    }

    public function toOptionArray()
    {
        if (!$this->options) {
            $this->options = $this->collection->toOptionArray();
            $this->options[] = ['value' => '', 'label' => '---Select---'];
        }

        return $this->options;
    }

    public function getAllOptions()
    {
        return $this->toOptionArray();
    }
}
