<?php

namespace taskforce\abstracts;

class RefusalAction extends AbstractAction
{
    protected $nameAction = 'refusal';
    protected $interanlName = 'отказаться';

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
