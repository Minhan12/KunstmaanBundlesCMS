<?php

namespace Kunstmaan\MenuBundle\Service;

use Kunstmaan\MenuBundle\Entity\MenuItem;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class RenderService
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Environment $environment
     * @param $node
     * @param array $options
     *
     * @return string
     */
    public function renderMenuItemTemplate(Environment $environment, $node, $options = array())
    {
        $template = isset($options['template']) ? $options['template'] : false;
        if ($template === false) {
            $template = 'KunstmaanMenuBundle::menu-item.html.twig';
        }

        $hasActiveChild = false;
        if ($node['__children']) {
            foreach ($node['__children'] as $childNode) {
                if ($childNode['type'] == MenuItem::TYPE_PAGE_LINK) {
                    $childUrl = $this->router->generate('_slug', array('url' => $childNode['nodeTranslation']['url']));
                    if ($this->router->getContext()->getPathInfo() == $childUrl) {
                        $hasActiveChild = true;

                        break;
                    }
                }
            }
        }

        $active = false;
        if ($node['type'] == MenuItem::TYPE_PAGE_LINK) {
            $url = $this->router->generate('_slug', array('url' => $node['nodeTranslation']['url']));

            if ($this->router->getContext()->getPathInfo() == $url) {
                $active = true;
            }
        } else {
            $url = $node['url'];
        }

        if ($node['type'] == MenuItem::TYPE_PAGE_LINK) {
            if ($node['title']) {
                $title = $node['title'];
            } else {
                $title = $node['nodeTranslation']['title'];
            }
        } else {
            $title = $node['title'];
        }

        return $environment->render($template, array(
            'menuItem' => $node,
            'url' => $url,
            'options' => $options,
            'title' => $title,
            'active' => $active,
            'hasActiveChild' => $hasActiveChild,
        ));
    }
}
