<?php

namespace Pickling;

use Twig_Environment as Twig;

class Renderer
{
    /** @var Twig */
    private $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    public function homepage(array $features): string
    {
        return $this->twig->render('homepage', [
            'features' => $features,
        ]);
    }
}
