<?php

declare(strict_types=1);

namespace Buten\Sample\Plugin;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\InventoryApi\Api\SourceRepositoryInterface;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Magento\InventoryApi\Api\Data\SourceSearchResultsInterface;
use Magento\InventoryApi\Api\Data\SourceExtensionFactory;
use Buten\Sample\Api\ProductTypesRepositoryInterface;
use Buten\Sample\Api\Data\ProductTypesInterface;

class SourceRepositoryPlugin
{


    public function __construct(
        SourceExtensionFactory $extensionFactory,
        ProductTypesRepositoryInterface $productTypesRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->extensionFactory = $extensionFactory;
        $this->productTypesRepository = $productTypesRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param SourceRepositoryInterface $subject
     * @param SourceInterface $source
     * @return SourceInterface
     */
    public function afterGet(SourceRepositoryInterface $subject, SourceInterface $source)
    {
        $extensionAttributes = $source->getExtensionAttributes() ?: $this->extensionFactory->create();

        $productType = $source->getData('product_type_id');
        if (!is_null($productType)) {
            $extensionAttributes->setProductTypeId($productType);
        }

        $source->setExtensionAttributes($extensionAttributes);

        return $source;
    }

    /**
     * @param SourceRepositoryInterface $subject
     * @param SourceSearchResultsInterface $result
     * @return SourceSearchResultsInterface
     */
    public function afterGetList(SourceRepositoryInterface $subject, SourceSearchResultsInterface $result)
    {
        $products = [];
        $sources = $result->getItems();

        foreach ($sources as $source) {
            $extensionAttributes = $source->getExtensionAttributes() ?: $this->extensionFactory->create();

            $productType = $source->getData('product_type_id');
            if (!is_null($productType)) {
                $extensionAttributes->setProductTypeId($productType);
            }

            $source->setExtensionAttributes($extensionAttributes);
            $products[] = $source;
        }
        $result->setItems($products);
        return $result;
    }

    /**
     * @param SourceRepositoryInterface $sourceRepository
     * @param SourceInterface $source
     * @return SourceInterface[]
     */
    public function beforeSave(
        SourceRepositoryInterface $sourceRepository,
        SourceInterface $source
    ): array {
        $extensionAttributes = $source->getExtensionAttributes() ?: $this->extensionFactory->create();
        if ($extensionAttributes->getProductTypeId() !== null) {
            $source->setProductTypeId($extensionAttributes->getProductTypeId());
        }

        return [$source];
    }

}
