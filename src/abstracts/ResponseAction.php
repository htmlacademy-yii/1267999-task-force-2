<?php
declare(strict_types=1);
namespace taskforce\abstracts;

class ResponseAction extends AbstractAction
{
    protected $nameAction = 'response';
    protected $interanlName = 'откликнутьcя';

    public function rightsVerification(int $userId) : bool
    {
        if ($userId === $this->executorId) {
            return true;
        }
        return false;
    }
}
