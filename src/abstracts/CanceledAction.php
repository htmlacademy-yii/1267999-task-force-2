<?php

namespace taskforce\abstracts;

class CanceledAction extends AbstractAction
{
    protected $nameAction = 'canceled';
    protected $interanlName = 'отменить';

    public function rightsVerification($userId)
    {
        if ($userId === $this->customerId) {
            return true;
        }
        return false;
    }
}
