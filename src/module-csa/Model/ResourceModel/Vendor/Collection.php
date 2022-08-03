<?php declare(strict_types=1);

namespace Icube\Vendor\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Icube\Vendor\Model\Vendor;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Vendor::class, \Icube\Vendor\Model\ResourceModel\Vendor::class);
    }
}
