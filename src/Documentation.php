<?php

namespace Pickling;

class Documentation
{
    /** @var FeatureRepository */
    private $featureRepository;

    /** @var Renderer */
    private $renderer;

    public function __construct(string $featuresDir)
    {
        $this->featureRepository = new FeatureRepository($featuresDir);
        $this->renderer = new Renderer(TwigFactory::createInMemory());
    }

    public function homepage(): string
    {
        $features = $this->featureRepository->findAll();

        return $this->renderer->homepage($features);
    }
}
