<?php
namespace App;

use Naka507\PhpParser\NodeVisitorAbstract;
use Naka507\PhpParser\Node;
use Naka507\PhpParser\Node\Expr\Closure;
use Naka507\PhpParser\Node\Expr\FuncCall;
use Naka507\PhpParser\Node\Expr\MethodCall;
use Naka507\PhpParser\Node\Expr\Variable;
use Naka507\PhpParser\Node\Name;
use Naka507\PhpParser\Node\Param;
use Naka507\PhpParser\Node\Scalar\String_;
use Naka507\PhpParser\Node\Stmt\Class_;
use Naka507\PhpParser\Node\Stmt\ClassMethod;
use Naka507\PhpParser\Node\Stmt\Return_;
use Naka507\PhpParser\Node\Stmt\TraitUse;
use Naka507\PhpParser\NodeFinder;

class ProxyVisitor2 extends NodeVisitorAbstract
{
    protected $className;

    protected $proxyId;

    public function __construct($className, $proxyId)
    {
        $this->className = $className;
        $this->proxyId = $proxyId;
    }

    public function getProxyClassName()
    {
        return \basename(str_replace('\\', '/', $this->className)) . '_' . $this->proxyId;
    }

    public function getClassName()
    {
        return '\\' . $this->className . '_' . $this->proxyId;
    }

    /**
     * @return \PhpParser\Node\Stmt\TraitUse
     */
    private function getAopTraitUseNode()
    {
        // Use AopTrait trait use node
        return new TraitUse([new Name('\App\AopTrait')]);
    }

    public function leaveNode(Node $node)
    {
        // Proxy Class
        if ($node instanceof Class_) {
            // Create proxy class base on parent class
            return new Class_($this->getProxyClassName(), [
                'flags' => $node->flags,
                'stmts' => $node->stmts,
                'extends' => new Name('\\' . $this->className),
            ]);
        }
        // Rewrite public and protected methods, without static methods
        if ($node instanceof ClassMethod && !$node->isStatic() && ($node->isPublic() || $node->isProtected())) {
            // var_dump($node->name);die;
            // $methodName = $node->name->toString();
            $methodName = $node->name;
            // Rebuild closure uses, only variable
            $uses = [];
            foreach ($node->params as $key => $param) {
                if ($param instanceof Param) {
                    $uses[$key] = new Param($param->var, null, null, true);
                }
            }
            $params = [
                // Add method to an closure
                new Closure([
                    'static' => $node->isStatic(),
                    'uses' => $uses,
                    'stmts' => $node->stmts,
                ]),
                new String_($methodName),
                new FuncCall(new Name('func_get_args')),
            ];
            $stmts = [
                new Return_(new MethodCall(new Variable('this'), '__proxyCall', $params))
            ];
            $returnType = $node->getReturnType();
            if ($returnType instanceof Name && $returnType->toString() === 'self') {
                $returnType = new Name('\\' . $this->className);
            }
            return new ClassMethod($methodName, [
                'flags' => $node->flags,
                'byRef' => $node->byRef,
                'params' => $node->params,
                'returnType' => $returnType,
                'stmts' => $stmts,
            ]);
        }
    }

    public function afterTraverse(array $nodes)
    {
        $addEnhancementMethods = true;
        $nodeFinder = new NodeFinder();
        $nodeFinder->find($nodes, function (Node $node) use (
            &$addEnhancementMethods
        ) {
            if ($node instanceof TraitUse) {
                foreach ($node->traits as $trait) {
                    // Did AopTrait trait use ?
                    if ($trait instanceof Name && $trait->toString() === '\App\AopTrait') {
                        $addEnhancementMethods = false;
                        break;
                    }
                }
            }
        });
        // Find Class Node and then Add Aop Enhancement Methods nodes and getOriginalClassName() method
        $classNode = $nodeFinder->findFirstInstanceOf($nodes, Class_::class);
        $addEnhancementMethods && array_unshift($classNode->stmts, $this->getAopTraitUseNode());
        return $nodes;
    }
}
