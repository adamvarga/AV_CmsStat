<?php

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
        ->newTable($installer->getTable('av_cmsstat_views'))
        ->addColumn('page_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => false,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
                ), 'Page Id')
        ->addColumn('views', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity' => false,
            'unsigned' => true,
            'nullable' => false,
            'primary' => false,
                ), 'Views')
        ->addColumn('last_view', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    'identity' => false,
    'unsigned' => true,
    'nullable' => false,
    'primary' => false,
        ), 'Last View');
$installer->getConnection()->createTable($table);

$installer->endSetup();
