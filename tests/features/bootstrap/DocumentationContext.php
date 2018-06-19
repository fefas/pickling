<?php

use Behat\Behat\Context\Context;
use Pickling\Documentation;

class DocumentationContext implements Context
{
    /** @var Renderer */
    private $documentation;

    /** @var string */
    private $pageContent;

    /**
     * @BeforeScenario
     */
    public function setUpDocumentation(): void
    {
        $this->documentation = new Documentation(TMP_DIR);
    }

    /**
     * @When I want see the homepage
     */
    public function iWantSeeTheHomepage(): void
    {
        $this->pageContent = $this->documentation->homepage();
    }

    /**
     * @Then I get the following content:
     */
    public function iGetTheFollowingRenderedContent(string $expectedContent): void
    {
        assertXmlStringEqualsXmlString($expectedContent, $this->pageContent);
    }
}
