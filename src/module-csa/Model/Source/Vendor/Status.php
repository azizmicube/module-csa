<?php
namespace Icube\Vendor\Model\Source\Vendor;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [
            ['label' => __('Active'), 'value' => 'A'],
            ['label' => __('Inactive'), 'value' => 'I'],
            ['label' => __('Disable'), 'value' => 'D'],
        ];
    }
}
