<?php

namespace Codzo\ORM\Entity;

interface RemoteIPableInterface
{
    /**
     * Get remote_ip
     *
     * @return \String|null
     */
    public function getRemoteIP();

    /**
     * Pre-Persist callback to write remote ip
     * @ORM\PrePersist
     */
    public function remoteIPableOnPrePersist();
}
