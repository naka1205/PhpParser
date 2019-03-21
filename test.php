<?php
require __DIR__ . '/vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ );
define('APP_PATH', ROOT_PATH . DS . 'app');

use Naka507\PhpParser\ParserFactory;
use Naka507\PhpParser\NodeDumper;

$file = APP_PATH . '/Test.php';
$code = file_get_contents($file);

$parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP5);
$ast = $parser->parse($code);

$dumper = new NodeDumper();
echo $dumper->dump($ast) . "\n";