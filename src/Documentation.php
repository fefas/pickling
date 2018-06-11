<?php

namespace Pickling;

use Twig_Loader_Array;
use Twig_Environment;

class Documentation
{
    /** @var string */
    private $featuresDir;

    /** @var Renderer */
    private $renderer;

    public function __construct(string $featuresDir)
    {
        $this->featuresDir = $featuresDir;
        $this->renderer = new Renderer(TwigFactory::createInMemory());
    }

    public function homepage(): string
    {
        return $this->renderer->homepage($this->findFeatures());
    }

    private function findFeatures(): array
    {
        $resources = scandir($this->featuresDir);

        $features = [];
        foreach ($resources as $resource) {
            if (substr($resource, -8) !== '.feature') {
                continue;
            }

            $features[] = new Feature($resource);
        }

        return $features;
    }
}
