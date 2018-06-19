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
     * @Given the feature file :path with the following content:
     */
    public function theFeatureFileWithTheFollowingContent(string $path, string $content): void
    {
        $path = $this->processPath($path);

        file_put_contents($path, $content);
    }

    private function processPath(string $path): string
    {
        $path = FEATURES_TMP_DIR.$path;
        $parts = explode('/', $path);
        array_pop($parts);

        $folder = implode('/', $parts);

        if (false === file_exists($folder)) {
            mkdir($folder);
        }

        return $path;
    }
}
