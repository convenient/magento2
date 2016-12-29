<?php
namespace Magento\Store\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Class WebsiteListCommand
 * @package Magento\Store\Console\Command
 */
class WebsiteListCommand extends Command
{
    /** @var \Magento\Store\Api\WebsiteManagementInterface $storeManager */
    private $manager;

    public function __construct(
        \Magento\Store\Api\WebsiteRepositoryInterface $websiteManagement
    ) {
        $this->manager = $websiteManagement;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('store:website:list')
            ->setDescription('Displays the list of websites');

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $this->getHelperSet()->get('table');
        $table->setHeaders(['ID', 'Default Group Id', 'Name', 'Code', 'Sort Order', 'Is Default']);

        foreach ($this->manager->getList() as $website) {
            $table->addRow([
                $website->getId(),
                $website->getDefaultGroupId(),
                $website->getName(),
                $website->getCode(),
                $website->getData('sort_order'),
                $website->getData('is_default'),
            ]);
        }

         $table->render($output);
    }
}
