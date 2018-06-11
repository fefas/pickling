<?php

namespace Pickling;

class Renderer
{
    public function homepage(): string
    {
        return <<<BLA
<!DOCTYPE>
<html>
  <body>
    <h1>Features:</h1>
    <ul>
      <li>Some feature</li>
    </ul>
  </body>
</html>
BLA;
    }
}
