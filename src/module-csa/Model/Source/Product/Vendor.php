<?php
namespace Icube\Vendor\Model\Source\Product;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Data\OptionSourceInterface;

class Vendor implements OptionSourceInterface
{
    /**
     * @var ResourceConnection
     */
    protected $connection;

    public function __construct(
        ResourceConnection $resourceConnection
    )
    {
        $this->connection = $resourceConnection->getConnection();
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $data = [];

        $sql = "SELECT id, vendor_name FROM icube_vendor ORDER BY vendor_name ASC";
        $vendors = $this->connection->fetchAll($sql);

        foreach ($vendors as $vendor) {
            $data[] = [
                'value' => $vendor['id'], 
                'label' => $vendor['vendor_name'], 
            ];
        }

        return $data;
    }
}
