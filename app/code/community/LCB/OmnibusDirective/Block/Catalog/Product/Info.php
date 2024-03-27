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
        if ($product && $product->getFinalPrice() < $product->getPrice()) {
            $currentTimestamp = Mage::getModel('core/date')->timestamp(time());
            $fromDate = date('Y-m-d H:i:s', strtotime('-30 day', $currentTimestamp));
            $omnibusPrice = Mage::getModel('lcb_omnibusdirective/price')->getCollection()
                ->addFieldToFilter('sku', $product->getSku())
                ->addFieldToFilter('created_at', array('from' => $fromDate))
                ->getFirstItem();

            if (!$omnibusPrice->getId()) {
                $websiteId = Mage::app()->getStore()->getWebsiteId();
                $productRulePrice = Mage::getModel('catalogrule/rule')->calcProductPriceRule($product, $product->getPrice(), $websiteId);
                if ($productRulePrice == $product->getFinalPrice()) {
                    $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
                    $select = $connection->select()->from('catalogrule_product_price', 'latest_start_date')
                        ->where('product_id = ?', $product->getId())
                        ->where('rule_price = ?', $productRulePrice)
                        ->where('website_id = ?', $websiteId)
                        ->limit(1);
                    $ruleStartDate = $connection->fetchOne($select);

                    if (strtotime($ruleStartDate) < strtotime($fromDate)) {
                        $ruleStartDate = $fromDate;
                    }

                    $omnibusPrice->setCreatedAt($ruleStartDate);
                    $omnibusPrice->setSku($product->getSku());
                    $omnibusPrice->setPrice($product->getPrice());
                    $omnibusPrice->save();
                }
            }

            return $omnibusPrice;
        }
        
        return null;
    }
}
