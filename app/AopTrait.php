<?php
namespace App;

trait AopTrait
{
    /**
     * AOP proxy call method
     *
     * @param \Closure $closure
     * @param string   $method
     * @param array    $params
     * @return mixed|null
     * @throws \Throwable
     */
    public function __proxyCall(\Closure $closure, $method, array $params)
    {
        $res = $closure(...$params);
        if (is_string($res)) {
            $res .= '!';
        }
        return $res;
    }
}