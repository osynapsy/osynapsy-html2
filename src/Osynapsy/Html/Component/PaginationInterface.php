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

/**
 * Description of PaginationInterface
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
interface PaginationInterface
{
    public function addFilter($field, $value = null);

    public function loadData($requestPage);

    public function getEntity();

    public function getMeta($key);

    public function getOrderBy();

    public function setPageDimension($pageDimension);

    public function setParentComponent(string $id);

    public function showPageDimension();

    public function showPageInfo();
}
