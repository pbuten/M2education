<?php

namespace Buten\Sample\Ui\Component\Control\ProductType;

use Buten\Sample\Ui\Component\Control\ProductType\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        if ($this->getProductType()) {
            return [
                'id' => 'delete',
                'label' => __('Delete'),
                'on_click' => "deleteConfirm('" .__('Are you sure you want to delete this product type?') ."', '"
                    . $this->getUrl('*/*/delete', ['id' => $this->getProductType()]) . "', {data: {}})",
                'class' => 'delete',
                'sort_order' => 10
            ];
        }
        return [];
    }
}
