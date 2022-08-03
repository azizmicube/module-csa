<?php declare(strict_types=1);

namespace Icube\Vendor\Model;

use Magento\Framework\Model\AbstractModel;

class Product extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Product::class);
    }
}
