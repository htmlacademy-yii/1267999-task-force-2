<?php
declare(strict_types=1);
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
