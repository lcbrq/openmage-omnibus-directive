<?php
/**
 * @author Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_OmnibusDirective_Block_Catalog_Product_Info extends Mage_Core_Block_Template
{
    
    /**
     * @return LCB_OmnibusDirective_Model_Price
     */
    public function getPriceInfo()
    {
        $product = Mage::registry('current_product');
        if ($product) {
            return Mage::getModel('lcb_omnibusdirective/price')->getCollection()
                ->addFieldToFilter('sku', $product->getSku())
                ->getFirstItem();
        }
        
        return null;
    }
}
