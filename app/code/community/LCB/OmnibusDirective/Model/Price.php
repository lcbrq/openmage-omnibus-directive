<?php
/**
 * Class LCB_OmnibusDirective_Model_Price
 *
 * @author Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_OmnibusDirective_Model_Price extends Mage_Core_Model_Abstract
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'lcb_omnibus';

    /**
     * @var string
     */
    protected $_eventObject = 'price';

    protected function _construct()
    {
        $this->_init("lcb_omnibusdirective/price");
    }
}
