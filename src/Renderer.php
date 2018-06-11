<?php

namespace Pickling;

use Twig_Loader_Array;
use Twig_Environment;

class Renderer
{
    /** @var string */
    private $featuresDir;

    public function __construct(string $featuresDir)
    {
        $this->featuresDir = $featuresDir;
    }

    public function homepage(): string
    {
        $template = <<<BLA
<html>
  <body>
    <h1>Features:</h1>
    <ul>
    {% for feature in features %}
      <li>{{ feature }}</li>
    {% endfor %}
    </ul>
  </body>
</html>
BLA;

        $loader = new Twig_Loader_Array([
            'homepage' => $template,
        ]);

        $twig = new Twig_Environment($loader);

        return $twig->render('homepage', [
            'features' => $this->findFeatures()
        ]);
    }

    private function findFeatures(): array
    {
        $resources = scandir($this->featuresDir);

        $features = [];
        foreach ($resources as $resource) {
            if (substr($resource, -8) !== '.feature') {
                continue;
            }

            $feature = substr($resource, 0, -8);
            $feature = str_replace('-', ' ', $feature);

            $features[] = ucfirst($feature);
        }

        return $features;
    }
}
