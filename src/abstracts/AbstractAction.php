<?php

namespace taskforce\abstracts;

abstract class AbstractAction
{
    protected $executorId = null;
    protected $customerId = null;
    protected $userId = null;
    protected $nameAction = null;
    protected $interanlName = null;

    public function __construct($executorId, $customerId, $userId)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->userId = $userId;
    }

    public function getNameAction()
    {
        return $this->nameAction;
    }

    public function getInternalName()
    {
        return $this->interanlName;
    }

    abstract public function rightsVerification($userId);
}
