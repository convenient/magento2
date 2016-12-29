<?php
namespace Magento\Store\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Class StoreListCommand
 * @package Magento\Store\Console\Command
 */
class StoreListCommand extends Command
{
    /** @var \Magento\Store\Model\StoreManagerInterface $storeManager */
    private $storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('store:list')
            ->setDescription('Displays the list of stores');

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $this->getHelperSet()->get('table');
        $table->setHeaders(['ID', 'Website ID', 'Group ID', 'Name', 'Code', 'Sort Order', 'Is Active']);

        foreach ($this->storeManager->getStores(true, true) as $store) {
            $table->addRow([
                $store->getId(),
                $store->getWebsiteId(),
                $store->getStoreGroupId(),
                $store->getName(),
                $store->getCode(),
                $store->getData('sort_order'),
                $store->getData('is_active'),
            ]);
        }

        $table->render($output);
    }
}
