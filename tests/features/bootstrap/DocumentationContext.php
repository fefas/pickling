<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Pickling\Documentation;

class DocumentationContext implements Context
{
    /** @var Renderer */
    private $renderer;

    /** @var string */
    private $renderedContent;

    /**
     * @BeforeScenario
     */
    public function setUpDocumentation(): void
    {
        $this->renderer = new Documentation(TMP_DIR);
    }

    /**
     * @When I want see the homepage
     */
    public function iWantSeeTheHomepage(): void
    {
        $this->renderedContent = $this->renderer->homepage();
    }

    /**
     * @Then I get the following content:
     */
    public function iGetTheFollowingRenderedContent(string $expectedContent): void
    {
        assertXmlStringEqualsXmlString($expectedContent, $this->renderedContent);
    }
}
