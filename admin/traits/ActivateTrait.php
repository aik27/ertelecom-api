<?php

namespace admin\traits;

use Yii;

trait ActivateTrait
{
    /**
     * Set active status for current record
     *
     * @param int $status
     * @return void
     */

    public function setActive(int $status): void
    {
        $this->active = $status;
        $this->update();
    }

    /**
     * Switch active status for current record
     *
     * @return void
     */

    public function switchActive(): void
    {
        $this->active === self::ACTIVE_YES ?
            $this->active = self::ACTIVE_NO :
            $this->active = self::ACTIVE_YES;
        $this->update();
    }
}
