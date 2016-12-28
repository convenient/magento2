<?php

if (PHP_SAPI == 'cli') {
    \Magento\Framework\Console\CommandLocator::register(\Magento\Store\Console\CommandList::class);
}
