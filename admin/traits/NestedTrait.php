<?php

namespace admin\traits;

use Yii;

trait NestedTrait
{
    /**
     * Get parent records ids
     *
     * @param int $id current record id
     * @return array
     */

    public static function getParentIds(int $id): array
    {
        $data = [];
        $result = [];
        $records = self::find()->all();
        if (!empty($records)) {
            foreach ($records as $key => $item) {
                $data[$item['id']] = $item['owner_id'];
            }
            if (!empty($data)) {
                while (!empty($id)) {
                    $result[] = $id;
                    $id = $data[$id];
                }
            }
        }
        if (!empty($result)) {
            return count($result) > 1 ? array_reverse($result) : $result;
        }
        return [];
    }

    /**
     * Get children records ids
     *
     * @param int $id record id
     * @param array $result ids catalog for recursion [optional]
     * @return array
     */

    public static function getChildrenIds(int $id, array $result = []): array
    {
        $records = self::find()->where(['owner_id' => $id])->all();
        if (!empty($records)) {
            foreach ($records as $key => $item) {
                $result[] = $item['id'];
                $result = self::getChildrenIds($item['id'], $result);
            }
        }
        return !empty($result) ? $result : [];
    }

    /**
     * Get single record by id
     *
     * @param int $id
     */

    public static function getById($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * Get parent for current record
     *
     */

    public function getParent()
    {
        return self::findOne($this->owner_id);
    }

    /**
     * Get children for current record
     *
     * @return array
     */

    public function getChildren(): array
    {
        $childrenIds = self::getChildrenIds($this->id);
        return self::findAll($childrenIds);
    }

    /**
     * Delete children for current page
     *
     * @return void
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */

    public function deleteChildren(): void
    {
        $childrenIds = self::getChildrenIds($this->id);
        if (!empty($childrenIds)) {
            foreach ($childrenIds as $child) {
                $record = self::findOne($child);
                if (!empty($record)) {
                    $record->delete();
                }
            }
        }
    }

    public static function getBreadCrumbs(int $id, string $url, $fieldSearch, $fieldName = "name"): array
    {
        $breadCrumbs = [];
        $parents = self::getParentIds($id);
        if (!empty($parents)) {
            $i = 1;
            $count = count($parents);
            foreach ($parents as $key => $item) {
                $model = self::getById($item);
                if ($model->owner_id === 0 and $id === $model->id) {
                    $breadCrumbs[] = $model->{$fieldName};
                } else {
                    if ($i < $count) {
                        $breadCrumbs[] = [
                            'label' => $model->{$fieldName},
                            'url' => Yii::$app->urlManager->createUrl([$url, $fieldSearch => ['owner_id' => $model->id]]),
                        ];
                    } else {
                        $breadCrumbs[] = $model->{$fieldName};
                    }
                }
                $i++;
            }
        }
        return $breadCrumbs;
    }
}
