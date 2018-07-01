<?php

namespace Pickling;

use PHPUnit\Framework\TestCase;
use Twig_Loader_Filesystem as TwigLoader;
use Twig_Environment as Twig;

class RenderHomePageTest extends TestCase
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
    public function renderHomepage(): void
    {
        $expected = <<<HOMEPAGE
<html>
  <body>
    <h1>Features:</h1>
    <ul>
      <li><a href="?feature=/group/some3">Some Feature 3</a></li>
      <li><a href="?feature=/some1">Some Feature 1</a></li>
      <li><a href="?feature=/some2">Some Feature 2</a></li>
    </ul>
  </body>
</html>
HOMEPAGE;

        $homepage = $this->documentation->homepage();

        $this->assertXmlStringEqualsXmlString($expected, $homepage);
    }
}
