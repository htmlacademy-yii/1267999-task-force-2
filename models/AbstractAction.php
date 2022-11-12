<?php

namespace models;

abstract class AbstractAction
{
    public $executorId = null;
    public $customerId = null;
    public $userId = null;

    public function __construct($executorId, $customerId, $userId)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->userId = $userId;
    }
    abstract public function returnNameAction();

    abstract public function returnInternalName();

    abstract public function rightsVerification($userId);
}
