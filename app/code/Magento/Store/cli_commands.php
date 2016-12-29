<?php

if (PHP_SAPI == 'cli' && getenv('TEST_SUITE') === false && getenv('INTEGRATION_INDEX') === false) {
    \Magento\Framework\Console\CommandLocator::register(\Magento\Store\Console\CommandList::class);
}
