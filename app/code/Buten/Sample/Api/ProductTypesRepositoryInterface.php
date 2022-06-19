<?php

namespace Buten\Sample\Api;

use Buten\Sample\Api\Data\ProductTypesInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ProductTypesRepositoryInterface
{
    /**
     * @param int $id
     * @return ProductTypesInterface
     */
    public function get(int $id): ProductTypesInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ProductTypesSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ProductTypesSearchResultInterface;

    /**
     * @param ProductTypesInterface $productTypes
     * @return ProductTypesInterface
     */
    public function save(ProductTypesInterface $productTypes): ProductTypesInterface;

    /**
     * @param ProductTypesInterface $workingHours
     * @return bool
     */
    public function delete(ProductTypesInterface $workingHours): bool;
}
