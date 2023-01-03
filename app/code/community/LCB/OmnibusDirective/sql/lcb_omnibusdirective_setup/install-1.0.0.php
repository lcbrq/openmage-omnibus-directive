<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$priceTable = $installer->getConnection()->newTable($installer->getTable('lcb_omnibusdirective/price'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
             'identity' => true,
             'unsigned' => true,
             'nullable' => false,
             'primary'  => true,
        ),
        'Primary key of the price entry'
    )
    ->addColumn(
        'sku',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        array(),
        'Product SKU'
    )
    ->addColumn(
        'price',
        Varien_Db_Ddl_Table::TYPE_FLOAT,
        null,
        array(
             'unsigned' => true,
             'nullable' => false,
             'default'  => 0,
        ),
        'Lowest price in last 30 days'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_DATETIME,
        null,
        array(),
        'created at'
    );

$installer->getConnection()->createTable($priceTable);
$installer->endSetup();
