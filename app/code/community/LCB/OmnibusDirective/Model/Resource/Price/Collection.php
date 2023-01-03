<?php
/**
 * Class LCB_OmnibusDirective_Model_Resource_Price_Collection
 *
 * @author Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_OmnibusDirective_Model_Resource_Price_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('lcb_omnibusdirective/price');
    }
}
