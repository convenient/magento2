<?php
namespace Training\Test\Model\Config;

class Reader extends \Magento\Framework\Config\Reader\Filesystem
{
    protected $_idAttributes = []; //['/config/option' => 'name', '/config/option/inputType' => 'name'];

    public function __construct(
        \Magento\Framework\Config\FileResolverInterface $fileResolver,
        \Training\Test\Model\Config\Converter $converter,
        \Training\Test\Model\Config\SchemaLocator $schemaLocator,
        \Magento\Framework\Config\ValidationStateInterface $validationState,
        $fileName = 'test.xml',
        $idAttributes = [],
        $domDocumentClass = 'Magento\Framework\Config\Dom',
        $defaultScope = 'global'
    )
    {
        parent::__construct(
            $fileResolver,
            $converter,
            $schemaLocator,
            $validationState,
            $fileName,
            $idAttributes,
            $domDocumentClass,
            $defaultScope
        );
    }
}
