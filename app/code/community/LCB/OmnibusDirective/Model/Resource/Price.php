<?php
/**
 * Class LCB_OmnibusDirective_Model_Resource_Price
 *
 * @author Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_OmnibusDirective_Model_Resource_Price extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('lcb_omnibusdirective/price', 'entity_id');
    }

    /**
     * @param Mage_Core_Model_Abstract $object
     * @return type
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        if ($object->isObjectNew() || !$object->getId() || !$object->getCreatedAt()) {
            $object->setCreatedAt(Varien_Date::now());
        }

        return parent::_beforeSave($object);
    }
}
