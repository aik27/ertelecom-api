<?php

namespace admin\interfaces;

interface NestedInterface
{
    /**
     * Get parent records ids
     *
     * @param int $id current record id
     * @return array
     */
    public static function getParentIds(int $id): array;

    /**
     * Get children records ids
     *
     * @param int $id record id
     * @param array $result ids catalog for recursion [optional]
     * @return array
     */
    public static function getChildrenIds(int $id, array $result = []): array;

    /**
     * Get single record by id
     *
     * @param int $id
     */
    public static function getById($id);

    /**
     * Get parent for current record
     *
     */
    public function getParent();

    /**
     * Get children for current record
     *
     * @return array
     */
    public function getChildren(): array;
}