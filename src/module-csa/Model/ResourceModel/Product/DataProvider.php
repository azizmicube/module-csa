<?php

namespace Icube\Vendor\Model\ResourceModel\Product;

use Icube\Vendor\Model\ResourceModel\Product\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $productCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $productCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
    */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $vendor) {
            $this->loadedData[$vendor->getId()] = $vendor->getData();
        }
        return $this->loadedData;
    }
}