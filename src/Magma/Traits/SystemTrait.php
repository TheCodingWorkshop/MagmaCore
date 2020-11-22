<?php

declare(strict_types=1);

namespace Magma\Traits;

use Magma\Base\Exception\BaseLogicException;
use Magma\GlobalManager\GlobalManager;
use Magma\Session\SessionManager;

trait SystemTrait
{

    /**
     * Initialize the system session at the entry point with in the 
     * application
     *
     * @param boolean $useSessionGlobal
     * @return void
     */
    public static function sessionInit(bool $useSessionGlobal = false)
    {
        $session = SessionManager::initialize();
        if (!$session) {
            throw new BaseLogicException('Please enable session within your session.yaml configuration file.');
        } else if ($useSessionGlobal === true) {
            GlobalManager::set('global_session', $session);
        } else {
            return $session;
        }
        return false;
    }

}