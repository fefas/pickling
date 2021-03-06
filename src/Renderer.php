<?php

namespace Pickling;

use Twig_Environment as Twig;

class Renderer
{
    private const HOMEPAGE_TEMPLATE = 'homepage.twig.html';
    private const FEATUREPAGE_TEMPLATE = 'feature.twig.html';

    /** @var Twig */
    private $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    public function homepage(array $features): string
    {
        return $this->twig->render(self::HOMEPAGE_TEMPLATE, [
            'features' => $features,
        ]);
    }

    public function featurePage(array $features, Feature $currentFeature): string
    {
        return $this->twig->render(self::FEATUREPAGE_TEMPLATE, [
            'features' => $features,
            'currentFeature' => $currentFeature,
        ]);
    }
}
