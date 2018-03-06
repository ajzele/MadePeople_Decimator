<?php
/**
 * @author      Branko Ajzele <ajzele@gmail.com, branko@foggyline.net>
 * @category    MadePeople
 * @package     MadePeople_Decimator
 * @copyright   Copyright (c) Made People, info@madepeople.se, Frejgatan 18, 113 49 Stockholm
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/** @var $this Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('madepeople_decimator/log'))

    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Entity Id')

    ->addColumn('parent_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
    ), 'Parent Id')

    ->addColumn('m_factor', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
    ), 'Multiplication Factor - read from config, at created_at time')

    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
    ), 'Multiplied value - based on m_factor x sales order grand total')

    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Created At')

    ->addForeignKey($installer->getFkName('madepeople_decimator/log', 'parent_id', 'sales/order', 'entity_id'),
        'parent_id', $installer->getTable('sales/order'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)

    ->setComment('MadePeople Decimator Log');

$installer->getConnection()->createTable($table);

$installer->endSetup();