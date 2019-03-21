<?php
namespace App;

use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;

class ProxyVisitor extends NodeVisitorAbstract
{
    public function leaveNode(Node $node)
    {
    }

    public function afterTraverse(array $nodes)
    {
    }
}