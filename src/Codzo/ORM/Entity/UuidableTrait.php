<?php

namespace Codzo\ORM\Entity;

use Ramsey\Uuid\Uuid;

/**
 * Trait implementing UuidableInterface
 */
trait UuidableTrait
{
    /**
     * @var \String|null
     */
    public $uuid;

    /**
     * Get UUID
     *
     * @return \String|null
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Pre-Persist callback to write UUID
     * @ORM\PrePersist
     */
    public function uuidableOnPrePersist()
    {
        if (!$this->uuid) {
            $uuid = Uuid::uuid4();
            $this->uuid = $uuid->toString();
        }

        return $this;
    }
}
