<?php

namespace Pickling;

use Twig_Loader_Array as TwigLoader;
use Twig_Environment as Twig;

class TwigFactory
{
    private const TEMPLATE_HOMEPAGE = <<<TEMPALTE
<html>
  <body>
    <h1>Features:</h1>
    <ul>
    {% for feature in features %}
      <li>{{ feature.title() }}</li>
    {% endfor %}
    </ul>
  </body>
</html>
TEMPALTE;

    public static function createInMemory(): Twig
    {
        $loader = new TwigLoader([
            'homepage' => self::TEMPLATE_HOMEPAGE,
        ]);

        return new Twig($loader);
    }
}
