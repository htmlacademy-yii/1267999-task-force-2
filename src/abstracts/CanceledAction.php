<?php
declare(strict_types=1);
namespace taskforce\abstracts;

class CanceledAction extends AbstractAction
{
    protected $nameAction = 'canceled';
    protected $interanlName = 'отменить';

    public function rightsVerification(int $userId) : bool
    {
        if ($userId === $this->customerId) {
            return true;
        }
        return false;
    }
}
