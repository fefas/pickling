<?php

namespace Pickling;

trait FeatureFileFixtureTrait
{
    protected function cleanTmpDir(): void
    {
        $toDelete = TMP_DIR.'/*';
        exec("rm -r $toDelete");
    }

    protected function fixtureFeatureFile(string $path, string $content): void
    {
        file_put_contents(TMP_DIR.'/some-feature.feature', 'content');
    }
}
