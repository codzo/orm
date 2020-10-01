<?php

namespace Codzo\ORM\Entity;

interface TimestampableInterface
{

    /**
     * Get created timestamp in UTC.
     *
     * @return \DateTime|null
     */
    public function getUtcCreated();

    /**
     * Get updated timestamp in UTC.
     *
     * @return \DateTime|null
     */
    public function getUtcUpdated();
 
 
    /**
     * Pre-Persist callback to write UTC timestamp
     * @ORM\PrePersist
     */
    public function timestampableOnPrePersist();

    /**
     * Pre-Update callback to write UTC timestamp
     * @ORM\PreUpdate
     */
    public function timestampableOnPreUpdate();
}
