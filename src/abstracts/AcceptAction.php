<?php

namespace Abstracts;

class AcceptAction extends AbstractAction
{
    const NAME_ACTION = 'accept';
    const INTERNAL_NAME = 'принять';

    public function returnNameAction()
    {
        return self::NAME_ACTION;
    }

    public function returnInternalName()
    {
        return self::INTERNAL_NAME;
    }

    public function rightsVerification($userId)
    {
        if ($userId === $this->customerId) {
            return true;
        }
        return false;
    }
}

