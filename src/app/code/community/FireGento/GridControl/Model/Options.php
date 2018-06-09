<?php
/**
 * Detects the options for eav attributes
 */

class FireGento_GridControl_Model_Options
{
    /**
     * @param $params
     * @return array
     * @throws Mage_Exception
     */
    public function getOptions($params) {

        if(!is_array($params) || !count($params) == 2) {
            throw new Mage_Exception('Wrong usage: firegento_gridcontrol/options::getOptions(entityType,attribute)');
        }

        $entityType = $params[0];
        $attributeName = $params[1];

        $options = array();

        try {

            $attribute = Mage::getSingleton('eav/config')
                ->getAttribute($entityType, $attributeName);

        }
        catch (Exception $e) {
            throw new Mage_Exception('nonexistant entityType or attributeName', 0, $e);
        }

        if ($attribute->usesSource()) {
            $attributeOptions = $attribute->getSource()->getAllOptions(false);
            foreach($attributeOptions as $attributeOption) {
                $options[$attributeOption['value']] = $attributeOption['label'];
            }
        }

        return $options;
    }
}