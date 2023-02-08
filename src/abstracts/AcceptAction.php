<?php

namespace taskforce\abstracts;

class AcceptAction extends AbstractAction
{
    protected $nameAction = 'accept';
    protected $interanlName = 'принять';

    public function rightsVerification(int $userId) : bool
    {
        if ($userId === $this->customerId) {
            return true;
        }
        return false;
    }
}

