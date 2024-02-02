<?php

/*
 * This file is part of the Osynapsy package.
 *
 * (c) Pietro Celeste <p.celeste@osynapsy.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Osynapsy\Html\Helper;

use Osynapsy\Controller\ControllerInterface;

/**
 * Description of JQuery
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class JQuery
{
    private $elements = [];
    private $selector;
    private $controller;

    public function __construct($selector, ControllerInterface $controller = null)
    {
        $this->selector = $selector;
        $this->controller = $controller;
    }

    public function __call($method, $params)
    {
        $this->elements[$method] = $params;
        return $this;
    }

    public function __toString()
    {
        $string = '$(\''.$this->selector.'\')';
        foreach ($this->elements as $method => $parameters) {
            $string .= $this->buildMethod($method, $parameters);
        }
        return $string;
    }

    private function buildMethod($method, $parameters)
    {
        if (empty($parameters)) {
            return ".{$method}())";
        }
        $pars = implode(
            ",",
            array_map(
                function($value) {
                    switch (gettype($value)) {
                        case 'boolean':
                            return empty($value) ? 'false' : 'true';
                        case 'integer':
                        case 'double' :
                            return $value;
                        default:
                            return "'".addslashes($value)."'";
                    }
                },
                $parameters
            )
        );
        return '.'.$method."($pars)";
    }

    public function exec()
    {
        $this->controller->js($this);
    }
}
