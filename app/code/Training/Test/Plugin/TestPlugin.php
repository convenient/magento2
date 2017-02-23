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
        return 'Customised Copyright!';
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $product, $result)
    {
        return $result + rand(1, 10);
    }
}
