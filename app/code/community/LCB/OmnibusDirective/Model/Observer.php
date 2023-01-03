<?php
/**
 * Class LCB_OmnibusDirective_Model_Observer
 *
 * @author Tomasz Gregorczyk <tomasz@silpion.com.pl>
 */
class LCB_OmnibusDirective_Model_Observer
{

    /**
     * @param Varien_Event_Observer $observer
     * @return void
     */
    public function savePrice(Varien_Event_Observer $observer)
    {
        $product = $observer->getProduct();
        if ($product->getFinalPrice() < $product->getPrice()) {
            $priceModel = Mage::getModel('lcb_omnibusdirective/price')->getCollection()
                    ->addFieldToFilter('sku', $product->getSku())
                    ->getFirstItem();
            if (!$priceModel->getPrice() || $priceModel->getPrice() > $product->getFinalPrice()) {
                $priceModel->setSku($product->getSku());
                $priceModel->setPrice($product->getFinalPrice());
                try {
                    $priceModel->save();
                } catch (Exception $e) {
                    Mage::logException($e);
                }
            }
        }
    }
}
