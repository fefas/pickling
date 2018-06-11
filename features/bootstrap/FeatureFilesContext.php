<?php

use Behat\Behat\Context\Context;
//use Behat\Gherkin\Node\PyStringNode;

class FeatureFilesContext implements Context
{
    /**
     * @BeforeScenario
     */
    public function cleanTmpDir(): void
    {
        $toDelete = FEATURES_TMP_DIR.'/*';
        exec("rm -r $toDelete");
    }

    /**
     * @Given the feature file :file with the following content:
     */
    public function theFeatureFileWithTheFollowingContent(string $file, string $content): void
    {
        $file = FEATURES_TMP_DIR.$file;

        file_put_contents($file, $content);
    }
}
