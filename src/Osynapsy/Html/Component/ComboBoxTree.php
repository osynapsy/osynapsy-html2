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
 * Description of ComboBoxTree
 *
 * @author Pietro Celeste
 */
class ComboBoxTree extends ComboBox
{
    const FIELD_PARENT_IDX = 2;
    const MAIN_BRANCH_ID = '__root__';

    public $placeholder = ['', 'Seleziona .....', null];

    public function preBuild()
    {        
        $datasetGrouped = $this->datasetTreeFactory($this->dataset ?? []);
        if (!empty($datasetGrouped) && array_key_exists(self::MAIN_BRANCH_ID, $datasetGrouped)) {
            $this->treeFactory($datasetGrouped[self::MAIN_BRANCH_ID], $datasetGrouped);
        }
    }

    protected function datasetTreeFactory($rawDataset)
    {
        $datasetGrouped = [];
        foreach ($rawDataset as $rawDatasetRow) {
            $record = array_values($rawDatasetRow);
            $parentId = empty($record[self::FIELD_PARENT_IDX]) ? self::MAIN_BRANCH_ID : $record[self::FIELD_PARENT_IDX];
            if (!array_key_exists($parentId, $datasetGrouped)) {
                $datasetGrouped[$parentId] = [];
            }
            $datasetGrouped[$parentId][] = $record;
        }
        return $datasetGrouped;
    }

    protected function treeFactory(array $curDatasetBranch, array $datasetGrouped, int $level = 0)
    {        
        foreach ($curDatasetBranch as $leaf) {
            list($leafId, $leafLabel, ) = array_slice($leaf, 0, 3);
            $label = sprintf('%s%s', str_repeat('&nbsp;', $level * 5) , $leafLabel ?? $leafId);
            $this->optionFactory($leafId, $label, 0);
            if (array_key_exists($leafId, $datasetGrouped)) {
                $this->treeFactory($datasetGrouped[$leafId], $datasetGrouped, $level + 1);
            }
        }
    }   
}
