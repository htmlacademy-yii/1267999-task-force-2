<?php
declare(strict_types=1);
namespace taskforce\abstracts;

class CompletionAction extends AbstractAction
{
    protected $nameAction = 'completion';
    protected $interanlName = 'завершить';

    public function rightsVerification(int $userId) : bool
    {
        if ($userId === $this->customerId) {
            return true;
        }
        return false;
    }
}