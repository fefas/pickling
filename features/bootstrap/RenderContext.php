<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Pickling\Renderer;

class RenderContext implements Context
{
    /** @var Renderer */
    private $renderer;

    /** @var string */
    private $renderedContent;

    /**
     * @BeforeScenario
     */
    public function createRenderer(): void
    {
        $this->renderer = new Renderer(FEATURES_TMP_DIR);
    }

    /**
     * @When I render homepage
     */
    public function iRenderHomepage(): void
    {
        $this->renderedContent = $this->renderer->homepage();
    }

    /**
     * @Then I get the following rendered content:
     */
    public function iGetTheFollowingRenderedContent(string $expectedContent): void
    {
        assertXmlStringEqualsXmlString($expectedContent, $this->renderedContent);
    }
}
