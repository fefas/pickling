<?php

namespace Pickling;

use PHPUnit\Framework\TestCase;
use Twig_Loader_Filesystem as TwigLoader;
use Twig_Environment as Twig;

trait DocumentationTestTrait
{
    use FeatureFileFixtureTrait;

    protected function setUpDefaultFixtures(): void
    {
        $this->fixtureFeatureFile('/some1.feature', 'Feature: Some Feature 1');
        $this->fixtureFeatureFile('/some2.feature', 'Feature: Some Feature 2');
        $this->fixtureFeatureFile('/group/some3.feature', 'Feature: Some Feature 3');
    }

    protected function createDocumentation(): Documentation
    {
        $twig = new Twig(new TwigLoader(TEMPLATES_DIR));
        $renderer = new Renderer($twig);

        $parser = new Parser();
        $repository = new FeatureRepository(FEATURES_DIR, $parser);

        return new Documentation($repository, $renderer);
    }
}
