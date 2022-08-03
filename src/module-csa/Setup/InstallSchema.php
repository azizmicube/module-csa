<?php

namespace Icube\Vendor\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
        * Create table 'icube_vendor'
        */

        $table = $installer->getConnection()
            ->newTable($installer->getTable('icube_vendor'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                'vendor_name',
                Table::TYPE_TEXT,
                '255',
                ['nullable' => false],
                'Vendor Name'
            )
            ->addColumn(
                'address',
                Table::TYPE_TEXT,
                '255',
                ['nullable' => false],
                'Address'
            )
            ->addColumn(
                'vendor_code',
                Table::TYPE_TEXT,
                '255',
                ['nullable' => false],
                'Vendor Code'
            )
            ->addColumn(
                'kecamatan_code',
                Table::TYPE_TEXT,
                '255',
                ['nullable' => false],
                'Kecamatan Code'
            )
            ->addColumn(
                'longitude',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Longitude'
            )
            ->addColumn(
                'latitude',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Latitude'
            )
            ->addColumn(
                'status',
                Table::TYPE_TEXT,
                '1',
                ['nullable' => false],
                'Status (A=Active, I=Inactive, D=Disabled)'
            )
            ->setComment('Icube Vendor');

        $installer->getConnection()->createTable($table);

        /**
         * Create table 'icube_vendor_product'
         */

        $table = $installer->getConnection()
            ->newTable($installer->getTable('icube_vendor_product'))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Id'
            )
            ->addColumn(
                'vendor_id',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true],
                'Vendor Id'
            )
            ->addColumn(
                'sku',
                Table::TYPE_TEXT,
                '64',
                ['nullable' => false],
                'SKU'
            )
            ->addColumn(
                'stock',
                Table::TYPE_INTEGER,
                '255',
                ['nullable' => true, 'unsigned' => true],
                'Stock'
            )
            ->addColumn(
                'price',
                Table::TYPE_DECIMAL,
                '20,6',
                ['nullable' => true, 'unsigned' => true],
                'Price'
            )
            ->addColumn(
                'updated_at',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false],
                'Updated At'
            )
            ->setComment('Icube Vendor Product');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
