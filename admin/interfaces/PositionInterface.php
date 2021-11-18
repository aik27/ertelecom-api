<?php

namespace admin\interfaces;

interface PositionInterface
{
    /**
     * Set position for current record
     *
     * @param string $value
     * @return void
     */
    public function setPosition($value = ""): void;

    /**
     * Set position for multiply records
     *
     * @param array $position - id / value
     * @return void
     */
    public static function setPositionAll($position): void;

    /**
     * Rebuild position for all records
     *
     * @return void
     */
    public static function rebuildPosition(): void;
}