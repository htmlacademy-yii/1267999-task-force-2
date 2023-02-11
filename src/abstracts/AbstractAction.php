<?php
declare(strict_types=1);
namespace taskforce\abstracts;

abstract class AbstractAction
{
    protected $executorId = null;
    protected $customerId = null;
    protected $userId = null;
    protected $nameAction = null;
    protected $interanlName = null;

    public function __construct(int $executorId, int $customerId, int $userId)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->userId = $userId;
    }

    public function getNameAction() : string
    {
        return $this->nameAction;
    }

    public function getInternalName() : string
    {
        return $this->interanlName;
    }

    abstract public function rightsVerification(int $userId);
}
