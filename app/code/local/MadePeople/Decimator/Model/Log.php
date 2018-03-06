<?php

/**
 * @author      Branko Ajzele <ajzele@gmail.com, branko@foggyline.net>
 * @category    MadePeople
 * @package     MadePeople_Decimator
 * @copyright   Copyright (c) Made People, info@madepeople.se, Frejgatan 18, 113 49 Stockholm
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class MadePeople_Decimator_Model_Log extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('madepeople_decimator/log');
    }
}
