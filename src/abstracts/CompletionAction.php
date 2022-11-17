<?php

namespace taskforce\abstracts;

class CompletionAction extends AbstractAction
{
    protected $nameAction = 'completion';
    protected $interanlName = 'завершить';

    public function rightsVerification($userId)
    {
        if ($userId === $this->customerId) {
            return true;
        }
        return false;
    }
}