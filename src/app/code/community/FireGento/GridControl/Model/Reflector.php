<?php
/**
 * Utitlity class to access and modify
 * protected properties and to execute
 * protected methods
 */
class FireGento_GridControl_Model_Reflector
{

    /**
     * allows invoking protected methods
     *
     * @param $object
     * @param string $methodName
     * @param mixed|null $params
     * @return mixed
     *
     * @throws ReflectionException
     */
    public function callProtectedMethod($object, $methodName, $params = null)
    {
        $reflection = new ReflectionClass($object);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invoke($object, $params);
    }

    /**
     * gets reflected property
     *
     * @param Mage_Adminhtml_Block_Widget_Grid $grid
     * @param string $propertyName
     * @return ReflectionProperty
     *
     * @throws ReflectionException
     */
    public function getReflectedProperty(Mage_Adminhtml_Block_Widget_Grid $grid, $propertyName)
    {
        $reflection = new ReflectionClass($grid);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        return $property;
    }

    /**
     * gets a value of protected property on a grid object
     *
     * @param Mage_Adminhtml_Block_Widget_Grid $grid
     * @param string $propertyName
     * @return array
     *
     * @throws ReflectionException
     */
    public function getGridProtectedPropertyValue(Mage_Adminhtml_Block_Widget_Grid $grid, $propertyName)
    {
        $property = $this->getReflectedProperty($grid, $propertyName);
        return $property->getValue($grid);
    }

    /**
     * sets a value of protected property on a grid object
     *
     * @param Mage_Adminhtml_Block_Widget_Grid $grid
     * @param string $propertyName
     * @param mixed $propertyValue
     * @return Mage_Adminhtml_Block_Widget_Grid
     *
     * @throws ReflectionException
     */
    public function setGridProtectedPropertyValue(
        Mage_Adminhtml_Block_Widget_Grid $grid,
        $propertyName,
        $propertyValue
    )
    {
        $property = $this->getReflectedProperty($grid, $propertyName);
        $property->setValue($grid, $propertyValue);
    }

}