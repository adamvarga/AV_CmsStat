<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$conn = $installer->getConnection();
$table = $installer->getTable('cms_page');

$conn->addColumn(
        $table, 'stat_view', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
    'nullable' => false
        ), 'Statistic View Counter'
);
$conn->addColumn(
        $table, 'stat_last', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    'nullable' => false
        ), 'Statistic Last View'
);

$installer->endSetup();


