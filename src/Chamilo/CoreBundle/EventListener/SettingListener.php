<?php
/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Sylius\Bundle\SettingsBundle\Event\SettingsEvent;

/**
 * Class LocaleListener
 * @package Chamilo\CoreBundle\EventListener
 */
class SettingListener
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param SettingsEvent $event
     */
    public function onSettingPreSave(SettingsEvent $event)
    {
        $urlId = $this->container->get('request')->getSession()->get(
            'access_url_id'
        );

        $url = $this->container->get('doctrine')->getRepository(
            'ChamiloCoreBundle:AccessUrl'
        )->find($urlId);
        $event->setArgument('url', $url);
    }
}
