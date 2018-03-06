<?php

/**
 * @author      Branko Ajzele <ajzele@gmail.com, branko@foggyline.net>
 * @category    MadePeople
 * @package     MadePeople_Decimator
 * @copyright   Copyright (c) Made People, info@madepeople.se, Frejgatan 18, 113 49 Stockholm
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class MadePeople_Decimator_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_CONFIG_ACTIVE = 'sales/madepeople_decimator/active';
    const XML_PATH_CONFIG_M_FACTOR = 'sales/madepeople_decimator/m_factor';

    /**
     * Returns the value of enabled/disabled set by admin user
     *
     * @param null $moduleName
     * @return bool
     */
    public function isModuleEnabled($moduleName = null)
    {
        if (Mage::getStoreConfig(self::XML_PATH_CONFIG_ACTIVE) == '0') {
            return false;
        }

        return parent::isModuleEnabled($moduleName = null);
    }

    /**
     * Returns the value of multiplication factor set by admin user
     *
     * @param null $store
     * @return float
     */
    public function getMultiplicationFactor($store = null)
    {
        return floatval(Mage::getStoreConfig(self::XML_PATH_CONFIG_M_FACTOR, $store));
    }
}
