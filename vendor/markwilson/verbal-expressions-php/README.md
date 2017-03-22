# VerbalExpressionsPhp

PHP port of [jehna/VerbalExpressions][1].

## Example usage

```` php
<?php

require_once 'vendor/composer/autoload.php';

use MarkWilson\VerbalExpression;

// initialise verbal expression instance
$verbalExpression = new VerbalExpression();

// URL matcher
$verbalExpression->startOfLine()
                 ->then('http')
                 ->maybe('s')
                 ->then('://')
                 ->maybe('www.')
                 ->anythingBut(' ')
                 ->endOfLine();

// compile expression - returns ^(http)(s)?(\:\/\/)(www\.)?([^\ ]*)$
$verbalExpression->compile();

// perform match
preg_match($verbalExpression, 'http://www.google.com');
````


  [1]: https://github.com/jehna/VerbalExpressions "jehna/VerbalExpressions"
