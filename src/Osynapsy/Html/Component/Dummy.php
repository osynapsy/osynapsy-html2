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

class Dummy extends Base
{
    public function __construct($name, $tag = 'div')
    {
        parent::__construct($tag, $name);
    }
}
