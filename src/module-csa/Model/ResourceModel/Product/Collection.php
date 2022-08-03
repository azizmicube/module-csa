<?php declare(strict_types=1);

namespace Icube\Vendor\Model\ResourceModel\Product;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Icube\Vendor\Model\Product;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Product::class, \Icube\Vendor\Model\ResourceModel\Product::class);
    }
}
