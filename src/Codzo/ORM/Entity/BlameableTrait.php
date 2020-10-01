<?php

namespace Codzo\ORM\Entity;

/**
 * Trait implementing BlameableInterface
 * Blameable will retrieve the name to blame from:
 *   - APP_WHOTOBLAME
 *   - APP_CURRENT_USER
 *   - php get_current_user()
 */
trait BlameableTrait
{
    /**
     * @var \String|null
     */
    private $created_by;

    /**
     * @var \String|null
     */
    private $updated_by;

    /**
     * @var \String|null
     */
    private $removed_by;

    /**
     * Get CreatedBy
     *
     * @return \String|null
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Get UpdatedBy
     *
     * @return \String|null
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Get RemovedBy
     *
     * @return \String|null
     */
    public function getRemovedBy()
    {
        return $this->removed_by;
    }
    /**
     * Pre-Persist callback to write createdBy
     * @ORM\PrePersist
     */
    public function blameableOnPrePersist()
    {
        $this->created_by = $this->getWhoToBlame();
    }

    /**
     * Pre-Update callback to write createdBy
     * @ORM\PreUpdate
     */
    public function blameableOnPreUpdate()
    {
        $this->updated_by = $this->getWhoToBlame();
    }

    /**
     * Pre-Remove callback to write createdBy
     * @ORM\PreRemove
     */
    public function blameableOnPreRemove()
    {
        $this->removed_by = $this->getWhoToBlame();
    }

    protected function getWhoToBlame()
    {
        if (!\defined('APP_WHOTOBLAME')) {
            switch (true) {
                case \defined('APP_CURRENT_USER'):
                    $who_to_blame = APP_CURRENT_USER ;
                    break;
                case \function_exists('posix_getpwuid'):
                    $process_user = \posix_getpwuid(\posix_geteuid());
                    $who_to_blame = $process_user['name'];
                    break;
                default:
                    $who_to_blame = \get_current_user();
                    break;
            }
            define('APP_WHOTOBLAME', $who_to_blame);
        }

        return APP_WHOTOBLAME;
    }
}
