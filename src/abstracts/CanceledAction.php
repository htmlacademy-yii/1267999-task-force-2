<?php

namespace Abstracts;

class CanceledAction extends AbstractAction
{
    const NAME_ACTION = 'canceled';
    const INTERNAL_NAME = 'отменить';

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
