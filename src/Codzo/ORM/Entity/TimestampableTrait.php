<?php

namespace Codzo\ORM\Entity;

trait TimestampableTrait
{
    /**
     * @var \DateTime|null
     */
    public $utc_created;

    /**
     * @var \DateTime|null
     */
    public $utc_updated;

    /**
     * Get created timestamp in UTC.
     *
     * @return \DateTime|null
     */
    public function getUtcCreated()
    {
        return $this->utc_created;
    }

    /**
     * Get updated timestamp in UTC.
     *
     * @return \DateTime|null
     */
    public function getUtcUpdated()
    {
        return $this->utc_updated;
    }

    /**
     * Pre-Persist callback to write UTC timestamp
     * @ORM\PrePersist
     */
    public function timestampableOnPrePersist()
    {
        return $this->fulfillUTCNow();
    }

    /**
     * Pre-Update callback to write UTC timestamp
     * @ORM\PreUpdate
     */
    public function timestampableOnPreUpdate()
    {
        return $this->fulfillUTCNow();
    }

    /**
     * Pre-Flush callback to write UTC timestamp
     * @ORM\PrePersist
     */
    public function fulfillUTCNow()
    {
        static $utctz;
        if (!$utctz) {
            $utctz = new \DateTimeZone('UTC');
        }

        $now = new \DateTime('now', $utctz);

        if (!$this->utc_created) {
            $this->utc_created = $now;
        };
        $this->utc_updated = $now;

        return $this;
    }
}
