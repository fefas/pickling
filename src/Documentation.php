<?php

namespace Pickling;

class Documentation
{
    /** @var FeatureRepository */
    private $featureRepo;

    /** @var Renderer */
    private $renderer;

    public function __construct(FeatureRepository $featureRepo, Renderer $renderer)
    {
        $this->featureRepo = $featureRepo;
        $this->renderer = $renderer;
    }

    public function homepage(): string
    {
        $features = $this->featureRepo->findAll();

        return $this->renderer->homepage($features);
    }

    public function featurePage(string $featureId): string
    {
        $features = $this->featureRepo->findAll();
        $feature = $this->featureRepo->findOne($featureId);

        return $this->renderer->featurePage($features, $feature);
    }
}
