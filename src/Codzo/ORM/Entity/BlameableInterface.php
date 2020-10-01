<?php

namespace Codzo\ORM\Entity;

interface BlameableInterface
{
    /**
     * Get createdBy
     *
     * @return \String|null
     */
    public function getCreatedBy();

    /**
     * Get updatedBy
     *
     * @return \String|null
     */
    public function getUpdatedBy();

    /**
     * Get removedBy
     *
     * @return \String|null
     */
    public function getRemovedBy();

    /**
     * Pre-Persist callback to write createdBy
     * @ORM\PrePersist
     */
    public function blameableOnPrePersist();

    /**
     * Pre-Update callback to write createdBy
     * @ORM\PreUpdate
     */
    public function blameableOnPreUpdate();

    /**
     * Pre-Remove callback to write createdBy
     * @ORM\PreRemove
     */
    public function blameableOnPreRemove();
}
