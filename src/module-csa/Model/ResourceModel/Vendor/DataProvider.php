<?php

namespace Icube\Vendor\Model\ResourceModel\Vendor;

use Icube\Vendor\Model\ResourceModel\Vendor\CollectionFactory;

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
        CollectionFactory $vendorCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $vendorCollectionFactory->create();
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