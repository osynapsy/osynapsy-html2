<?php

/*
 * This file is part of the Osynapsy package.
 *
 * (c) Pietro Celeste <p.celeste@osynapsy.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Osynapsy\Html\Component;


class Link extends Base
{
    public function __construct($id, $link, $label, $class = '')
    {
        parent::__construct('a', $id);
        $this->add($label);
        $this->setHref($link);
        if (!empty($class)) {
            $this->addClass($class);
        }
    }

    public function setHref($uri)
    {
        $this->attribute('href', empty($uri) ? 'javascript:void(0);' : $uri);
    }

    public function appendToHref($uri)
    {        
        $this->setHref($this->getAttribute('href').$uri);
    }
}
