<?php

namespace models;

class ResponseAction extends AbstractAction
{
    const NAME_ACTION = 'response';
    const INTERNAL_NAME = 'откликнутьcя';

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
