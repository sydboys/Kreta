<?php

/**
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Bundle\NotificationBundle\DependencyInjection;

use Kreta\Bundle\CoreBundle\DependencyInjection\Abstracts\AbstractExtension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class KretaNotificationExtension.
 *
 * @package Kreta\Bundle\NotificationBundle\DependencyInjection
 */
class KretaNotificationExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    protected function getConfigFilesLocation()
    {
        return __DIR__ . '/../Resources/config';
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigurationInstance()
    {
        return new Configuration();
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigFiles()
    {
        return ['events', 'factories', 'notifiers', 'parameters', 'repositories', 'subscribers'];
    }
}
