<?php

namespace admin\interfaces;

interface ActivateInterface
{
    /**
     * Set active status for current record
     *
     * @param int $status
     * @return void
     */
    public function setActive(int $status): void;

    /**
     * Switch active status for current record
     *
     * @return void
     */
    public function switchActive(): void;
}