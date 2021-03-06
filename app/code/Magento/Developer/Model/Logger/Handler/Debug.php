<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Developer\Model\Logger\Handler;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\State;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Debug
 */
class Debug extends \Magento\Framework\Logger\Handler\Debug
{
    /**
     * @var State
     */
    private $state;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param DriverInterface $filesystem
     * @param State $state
     * @param ScopeConfigInterface $scopeConfig
     * @param string $filePath
     */
    public function __construct(
        DriverInterface $filesystem,
        State $state,
        ScopeConfigInterface $scopeConfig,
        $filePath = null
    ) {
        parent::__construct($filesystem, $filePath);

        $this->state = $state;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function isHandling(array $record)
    {
        return
            parent::isHandling($record)
            && $this->state->getMode() !== State::MODE_PRODUCTION
            && $this->scopeConfig->getValue('dev/debug/debug_logging', ScopeInterface::SCOPE_STORE);
    }
}