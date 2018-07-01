<?php

namespace Pickling;

use PHPUnit\Framework\TestCase;
use Twig_Loader_Filesystem as TwigLoader;
use Twig_Environment as Twig;

class RenderFeaturePageTest extends TestCase
{
    use DocumentationTestTrait;

    /** @var Documentation */
    private $documentation;

    protected function setUp(): void
    {
        $this->setUpDefaultFixtures();
        $this->documentation = $this->createDocumentation();
    }

    /**
     * @test
     */
    public function renderFeaturePage(): void
    {
        $expected = <<<HOMEPAGE
<html>
  <body>
    <h1>Some Feature 1</h1>
    <p>Feature: Some Feature 1</p>
  </body>
</html>
HOMEPAGE;

        $featurePage = $this->documentation->featurePage('/some1');

        $this->assertXmlStringEqualsXmlString($expected, $featurePage);
    }
}
