<?php

namespace Models;
use Abstracts\AcceptAction;
use Abstracts\CanceledAction;
use Abstracts\CompletionAction;
use Abstracts\RefusalAction;
use Abstracts\ResponseAction;

class BaseTask
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

    public function __construct($executorId, $customerId, $userId, $status)
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
                $this->responseAction->returnNameAction() => $this->responseAction->returnInternalName(),
                $this->canceledAction->returnNameAction() => $this->canceledAction->returnInternalName(),
                $this->acceptAction->returnNameAction() => $this->acceptAction->returnInternalName(),
                $this->refusalAction->returnNameAction() => $this->refusalAction->returnInternalName(),
                $this->completionAction->returnNameAction() => $this->completionAction->returnInternalName()
            ]
        ];
    }

    public function returnResponseAction() {
        return $this->responseAction;
    }

    public function returnCanceledAction() {
        return $this->canceledAction;
    }

    public function returnAcceptAction() {
        return $this->acceptAction;
    }

    public function returnRefusalAction() {
        return $this->refusalAction;
    }

    public function returnCompletionAction() {
        return $this->completionAction;
    }

    public function returnuserId() {
        return $this->userId;
    }

    public function returnMap() {
        return $this->map;
    }



    public function transitionStatus($action)
    {
        switch ($action) {
            case $this->completionAction->returnNameAction():
                return [self::STATUS_DONE];
            case $this->canceledAction->returnNameAction():
                return [self::STATUS_CANCELED];
            case $this->refusalAction->returnNameAction():
                return [self::STATUS_FAILED];
            default:
                return [];
        }
    }

    public function getAvailableActions($userId)
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