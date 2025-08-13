<?php

namespace Codzo\ORM\Entity;

/**
 * Trait implementing BlameableInterface
 * Blameable will retrieve the name to blame from:
 *   - APP_WHOTOBLAME
 *   - APP_CURRENT_USER
 *   - php get_current_user()
 */
trait RemoteIPableTrait
{
    /**
     * @var \String|null
     */
    public $remote_ip;

    /**
     * Get CreatedBy
     *
     * @return \String|null
     */
    public function getRemoteIP()
    {
        return $this->remote_ip;
    }

    /**
     * Pre-Persist callback to write createdBy
     * @ORM\PrePersist
     */
    public function remoteIPableOnPrePersist()
    {
        $this->remote_ip = $_SERVER['REMOTE_ADDR'] ?? 'local';
    }
}
