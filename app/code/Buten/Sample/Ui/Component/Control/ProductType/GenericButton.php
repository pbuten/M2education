<?php

namespace Buten\Sample\Ui\Component\Control\ProductType;

use Buten\Sample\Model\ProductTypesRepository;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;

class GenericButton
{
    private UrlInterface $urlBuilder;
    private RequestInterface $request;
    private ProductTypesRepository $productTypesRepository;

    public function __construct(
        UrlInterface $urlBuilder,
        RequestInterface $request,
        ProductTypesRepository $productTypesRepository
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
        $this->productTypesRepository = $productTypesRepository;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    public function getProductType()
    {
        $productTypeId = $this->request->getParam('id');
        if ($productTypeId === null) {
            return 0;
        }
        $productType = $this->productTypesRepository->get($productTypeId);

        return $productType->getId() ?: null;
    }
}
