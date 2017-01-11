<?php
namespace Magento\Store\Console;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\DeploymentConfig;

/**
 * Class CommandList
 */
class CommandList implements \Magento\Framework\Console\CommandListInterface
{
    /**
     * Object Manager
     *
     * @var ObjectManagerInterface
     */
    private $objectManager;
    
    /**
     * Deployment Config
     *
     * @var DeploymentConfig
     */
    private $deploymentConfig;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param DeploymentConfig $deploymentConfig
     */
    public function __construct(ObjectManagerInterface $objectManager, DeploymentConfig $deploymentConfig)
    {
        $this->objectManager = $objectManager;
        $this->deploymentConfig = $deploymentConfig;
    }

    /**
     * @return array
     */
    protected function getCommandsClassesWhichRequireInstallation()
    {
        return [
            \Magento\Store\Console\Command\StoreListCommand::class,
            \Magento\Store\Console\Command\WebsiteListCommand::class,
        ];
    }

    /**
     * @return array
     */
    protected function getCommandsClassesWhichDoNotRequireInstallation()
    {
        return [];
    }

    /**
     * Gets list of command classes
     *
     * @return string[]
     */
    protected function getCommandsClasses()
    {
        $commands = $this->getCommandsClassesWhichDoNotRequireInstallation();

        if ($this->deploymentConfig->isAvailable()) {
            $commands = array_merge($commands, $this->getCommandsClassesWhichRequireInstallation());
        }

        return $commands;
    }

    /**
     * {@inheritdoc}
     */
    public function getCommands()
    {
        $commands = [];
        foreach ($this->getCommandsClasses() as $class) {
            if (class_exists($class)) {
                $commands[] = $this->objectManager->get($class);
            } else {
                throw new \Exception('Class ' . $class . ' does not exist');
            }
        }
        return $commands;
    }
}
