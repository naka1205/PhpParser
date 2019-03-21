<?php
require __DIR__ . '/vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ );
define('APP_PATH', ROOT_PATH . DS . 'app');


use App\ProxyVisitor2;
use Naka507\PhpParser\ParserFactory;
use Naka507\PhpParser\NodeTraverser;
use Naka507\PhpParser\PrettyPrinter\Standard;

$file = APP_PATH . '/Test.php';
$code = file_get_contents($file);

$parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP5);
$ast = $parser->parse($code);

$traverser = new NodeTraverser();
$className = 'App\\Test';
$proxyId = uniqid();
$visitor = new ProxyVisitor2($className, $proxyId);
$traverser->addVisitor($visitor);
$proxyAst = $traverser->traverse($ast);
if (!$proxyAst) {
    throw new \Exception(sprintf('Class %s AST optimize failure', $className));
}
$printer = new Standard();
$proxyCode = $printer->prettyPrint($proxyAst);

// echo $proxyCode;

eval($proxyCode);

$class = $visitor->getClassName();
$bean = new $class();

echo $bean->show();