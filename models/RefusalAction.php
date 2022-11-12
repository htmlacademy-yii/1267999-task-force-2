<?php

namespace models;

class RefusalAction extends AbstractAction
{
    const NAME_ACTION = 'refusal';
    const INTERNAL_NAME = 'отказаться';

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
        if ($userId === $this->executorId) {
            return true;
        }
        return false;
    }
}
