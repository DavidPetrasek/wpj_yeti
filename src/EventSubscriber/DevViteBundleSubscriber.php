<?php declare(strict_types=1);

namespace App\EventSubscriber;

use Nelmio\SecurityBundle\EventListener\ContentSecurityPolicyListener;
use Pentatrion\ViteBundle\Event\RenderAssetTagEvent;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\When;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

// https://github.com/lhapaipai/symfony-vite-dev/pull/49#issuecomment-2423210263

#[When(env: 'dev')]
class DevViteBundleSubscriber implements EventSubscriberInterface
{
    public function __construct
    (
        // https://github.com/nelmio/NelmioSecurityBundle/issues/345
        #[Autowire(service: 'nelmio_security.csp_listener')]
        private readonly ContentSecurityPolicyListener $listener,
    )
    {}

    public function onRenderAssetTag(RenderAssetTagEvent $event): void
    {
        $tag = $event->getTag();
        if ($tag->isInternal()) 
        {
            $tag->setAttribute('nonce', $this->listener->getNonce('script'));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RenderAssetTagEvent::class => 'onRenderAssetTag',
        ];
    }
}
