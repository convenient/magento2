<?php
namespace Training\Test\Plugin;

class TestPlugin
{
    public function beforeAddCrumb(\Magento\Theme\Block\Html\Breadcrumbs $breadcrumbs, $crumbName, $crumbInfo)
    {
        $crumbName .= ' | Moose';
        return [$crumbName, $crumbInfo];
    }

    public function afterGetCopyright(\Magento\Theme\Block\Html\Footer $footer, $result)
    {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $config = $objectManager->get('Training\Test\Model\Config\ConfigInterface');

        $myNodeInfo = $config->getMyNodeInfo();

        return json_encode($myNodeInfo);
        return 'Customised Copyright!';
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $product, $result)
    {
        return $result + rand(1, 10);
    }
}
