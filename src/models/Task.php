<?php
declare(strict_types=1);
namespace taskforce\models;
use taskforce\abstracts\AcceptAction;
use taskforce\abstracts\CanceledAction;
use taskforce\abstracts\CompletionAction;
use taskforce\abstracts\RefusalAction;
use taskforce\abstracts\ResponseAction;
use taskforce\exception\StatusException;
use taskforce\exception\UserException;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_WORK = 'work';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';


    protected $responseAction = null;
    protected $canceledAction = null;
    protected $acceptAction = null;
    protected $refusalAction = null;
    protected $completionAction = null;
    protected $executorId = null;
    protected $customerId = null;
    protected $userId = null;
    protected $status = null;
    protected $map = null;

    public function __construct(int $executorId, int $customerId, int $userId, string $status)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->userId = $userId;
        $this->status = $status;
        $this->responseAction = new ResponseAction($executorId, $customerId, $userId);
        $this->canceledAction = new CanceledAction($executorId, $customerId, $userId);
        $this->acceptAction = new AcceptAction($executorId, $customerId, $userId);
        $this->refusalAction = new RefusalAction($executorId, $customerId, $userId);
        $this->completionAction = new CompletionAction($executorId, $customerId, $userId);
        $this->map = [
            'status' => [
                self::STATUS_NEW => 'новое',
                self::STATUS_CANCELED => 'отменено',
                self::STATUS_WORK => 'в работе',
                self::STATUS_DONE => 'выполнено',
                self::STATUS_FAILED => 'провалено'
            ],
            'action' => [
                $this->responseAction->getNameAction() => $this->responseAction->getInternalName(),
                $this->canceledAction->getNameAction() => $this->canceledAction->getInternalName(),
                $this->acceptAction->getNameAction() => $this->acceptAction->getInternalName(),
                $this->refusalAction->getNameAction() => $this->refusalAction->getInternalName(),
                $this->completionAction->getNameAction() => $this->completionAction->getInternalName()
            ]
        ];
    }

    public function testValue() : void
    {
        if ($this->executorId < 1) {
            throw new UserException("id исполнителя должно быть больше 0");
        }
        if ($this->customerId < 1) {
            throw new UserException("id заказчика должно быть больше 0");
        }
        if ($this->userId < 1) {
            throw new UserException("id пользователя должно быть больше 0");
        }
        if (!array_key_exists($this->status,  $this->map['status'])) {
            throw new StatusException("Не корректно указан статус");
        }

    }

    public function getResponseAction() : string
    {
        return $this->responseAction;
    }

    public function getCanceledAction() : string
    {
        return $this->canceledAction;
    }

    public function getAcceptAction() : string
    {
        return $this->acceptAction;
    }

    public function getRefusalAction() : string
    {
        return $this->refusalAction;
    }

    public function getCompletionAction() : string
    {
        return $this->completionAction;
    }

    public function getuserId() : int
    {
        return $this->userId;
    }

    public function getMap() : array
    {
        return $this->map;
    }

    public function transitionStatus(string $action) : string
    {
        switch ($action) {
            case $this->completionAction->getNameAction():
                return [self::STATUS_DONE];
            case $this->canceledAction->getNameAction():
                return [self::STATUS_CANCELED];
            case $this->refusalAction->getNameAction():
                return [self::STATUS_FAILED];
            default:
                return [];
        }
    }

    public function getAvailableActions(int $userId) : string
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                if ($userId === $this->executorId) {
                    return $this->responseAction;
                } elseif ($userId === $this->customerId) {
                    return [$this->acceptAction, $this->canceledAction];
                }
            case self::STATUS_WORK:
                if ($userId === $this->executorId) {
                    return $this->refusalAction;
                } elseif ($userId === $this->customerId) {
                    return $this->completionAction;
                }
            default:
                return [];
        }
    }
}