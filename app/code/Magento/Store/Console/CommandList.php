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
        $requiresInstallation = $this->getCommandsClassesWhichRequireInstallation();
        $doesNotRequireInstallation = $this->getCommandsClassesWhichDoNotRequireInstallation();

        if ($this->deploymentConfig->isAvailable()) {
            return array_merge($requiresInstallation, $doesNotRequireInstallation);
        } else {
            return $doesNotRequireInstallation;
        }
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
