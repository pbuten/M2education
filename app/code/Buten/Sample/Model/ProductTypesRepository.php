<?php

namespace Buten\Sample\Model;

use Buten\Sample\Api\Data\ProductTypesInterface;
use Buten\Sample\Api\ProductTypesRepositoryInterface;
use Buten\Sample\Api\ProductTypesSearchResultInterface;
use Buten\Sample\Model\ResourceModel\ProductTypes\CollectionFactory;
use Buten\Sample\Model\ResourceModel\ProductTypes as ProductTypesResource;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Buten\Sample\Api\ProductTypesSearchResultInterfaceFactory;
use Buten\Sample\Model\ProductTypesFactory;
use Magento\Framework\Exception\StateException;

class ProductTypesRepository implements ProductTypesRepositoryInterface
{
    private CollectionFactory $collectionFactory;
    private ProductTypesResource $productTypesResource;
    private ProductTypesFactory $productTypesFactory;
    private ProductTypesSearchResultInterfaceFactory $searchResultInterfaceFactory;

    /**
     * @param ProductTypesFactory $productTypesFactory
     * @param CollectionFactory $collectionFactory
     * @param ProductTypesResource $productTypesResource
     * @param ProductTypesSearchResultInterfaceFactory $searchResultInterfaceFactory
     */
    public function __construct(
        ProductTypesFactory $productTypesFactory,
        CollectionFactory $collectionFactory,
        ProductTypesResource  $productTypesResource,
        ProductTypesSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->productTypesFactory = $productTypesFactory;
        $this->collectionFactory = $collectionFactory;
        $this->productTypesResource = $productTypesResource;
        $this->searchResultFactory = $searchResultInterfaceFactory;
    }

    /**
     * @param int $id
     * @return ProductTypesInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id): ProductTypesInterface
    {
        $object = $this->productTypesFactory->create();
        $this->productTypesResource->load($object, $id);
        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity with ID "%1"', $id));
        }
        return $object;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ProductTypesSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ProductTypesSearchResultInterface
    {
        $collection = $this->collectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }

    /**
     * @param ProductTypesInterface $productTypes
     * @return ProductTypesInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(ProductTypesInterface $productTypes): ProductTypesInterface
    {
        $this->productTypesResource->save($productTypes);
        return $productTypes;
    }

    /**
     * @param ProductTypesInterface $workingHours
     * @return bool
     */
    public function delete(ProductTypesInterface $workingHours): bool
    {
        try {
            $this->productTypesResource->delete($workingHours);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove entity #%1', $workingHours->getId()));
        }
        return true;
    }
}
