<?php

namespace admin\traits;

use Yii;

trait PositionTrait
{
    /**
     * Set position for current record
     *
     * @param string $value
     * @return void
     */

    public function setPosition($value = ""): void
    {
        $max = self::find()->max('position');
        if ($max <= 0) {
            $max = 2;
        }
        if (empty($value)) {
            $value = $max + 2;
        }
        $this->position = $value;
        if (!$this->save()) {
            throw new \Exception("Can't save position");
        }
    }

    /**
     * Set position for multiply records
     *
     * @param array $position - id / value
     * @return void
     */

    public static function setPositionAll($position): void
    {
        if (!empty($position) and is_array($position)) {
            foreach ($position as $key => $value) {
                $record = self::findOne(['id' => $key]);
                if (!empty($record)) {
                    $record->position = $value;
                    if (!$record->save()) {
                        throw new \Exception("Can't save position");
                    }
                }
            }
            self::rebuildPosition();
        }
    }

    /**
     * Rebuild position for all records
     *
     * @return void
     * @throws \Exception
     */

    public static function rebuildPosition(): void
    {
        $i = 2;
        $records = self::find()->orderBy(['position' => SORT_ASC])->all();
        if (!empty($records)) {
            foreach ($records as $record) {
                $record->position = $i;
                if (!$record->save()) {
                    throw new \Exception("Can't save position");
                }
                $i = $i + 2;
            }
        }
    }
}
