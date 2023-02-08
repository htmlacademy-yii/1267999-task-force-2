<?php

namespace taskforce\abstracts;

class RefusalAction extends AbstractAction
{
    protected $nameAction = 'refusal';
    protected $interanlName = 'отказаться';


    public function rightsVerification(int $userId) : bool
    {
        if ($userId === $this->executorId) {
            return true;
        }
        return false;
    }
}
