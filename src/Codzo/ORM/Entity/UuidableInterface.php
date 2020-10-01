<?php

namespace Codzo\ORM\Entity;

interface UuidableInterface
{

    /**
     * Get UUID
     *
     * @return \String|null
     */
    public function getUuid();

    /**
     * Pre-Persist callback to write UUID
     * @ORM\PrePersist
     */
    public function uuidableOnPrePersist();
}
