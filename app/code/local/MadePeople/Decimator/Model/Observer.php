<?php

/**
 * @author      Branko Ajzele <ajzele@gmail.com, branko@foggyline.net>
 * @category    MadePeople
 * @package     MadePeople_Decimator
 * @copyright   Copyright (c) Made People, info@madepeople.se, Frejgatan 18, 113 49 Stockholm
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class MadePeople_Decimator_Model_Observer
{
    /**
     * @var MadePeople_Decimator_Helper_Data
     */
    protected $_helper;

    public function __construct()
    {
        $this->_helper = Mage::helper('madepeople_decimator');
    }

    /**
     * When an order is fully paid stores the order ID and the paid total sum multiplied by a decimal factor.
     *
     * @see app/code/core/Mage/Sales/Model/Order/Invoice.php for Mage::dispatchEvent('sales_order_invoice_pay'...
     */
    public function multiplyOrderByFactorAndLog($observer)
    {
        if ($this->_helper->isModuleEnabled() == false) {
            return;
        }

        $order = $observer->getInvoice()->getOrder();

        // We need to be careful to properly track "fully paid" order
        // If BaseTotalDue is 0, then order is fully paid
        if (floatval($order->getBaseTotalDue()) == 0) {
            $log = Mage::getModel('madepeople_decimator/log');
            $log->setParentId($order->getId());
            $log->setMFactor($this->_helper->getMultiplicationFactor());
            $log->setValue(floatval($order->getBaseGrandTotal() * $this->_helper->getMultiplicationFactor()));
            $log->setCreatedAt(Mage::getSingleton('core/date')->gmtDate());

            try {
                $log->save();
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
    }
}
