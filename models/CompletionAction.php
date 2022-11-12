<?php

namespace models;

class CompletionAction extends AbstractAction
{
    const NAME_ACTION = 'completion';
    const INTERNAL_NAME = 'завершить';

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