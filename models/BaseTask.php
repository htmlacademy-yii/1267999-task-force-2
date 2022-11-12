<?php

namespace models;
use models\AbstractAction;
use models\AcceptAction;
use models\CanceledAction;
use models\CompletionAction;
use models\RefusalAction;
use models\ResponseAction;

class BaseTask
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_WORK = 'work';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';


    public $responseAction = null;
    public $canceledAction = null;
    public $acceptAction = null;
    public $refusalAction = null;
    public $completionAction = null;
    public $executorId = null;
    public $customerId = null;
    public $userId = null;
    public $status = null;

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
    }

    public function returnMap(AbstractAction $responseAction, AbstractAction $canceledAction, AbstractAction $acceptAction, AbstractAction $refusalAction, AbstractAction $completionAction)
    {
        $map = [
            'status' => [
                self::STATUS_NEW => 'новое',
                self::STATUS_CANCELED => 'отменено',
                self::STATUS_WORK => 'в работе',
                self::STATUS_DONE => 'выполнено',
                self::STATUS_FAILED => 'провалено'
            ],
            'action' => [
                $responseAction->returnNameAction() => $responseAction->returnInternalName(),
                $canceledAction->returnNameAction() => $canceledAction->returnInternalName(),
                $acceptAction->returnNameAction() => $acceptAction->returnInternalName(),
                $refusalAction->returnNameAction() => $refusalAction->returnInternalName(),
                $completionAction->returnNameAction() => $completionAction->returnInternalName()
            ]
        ];
        return $map;
    }

    public function transitionStatus($action, AbstractAction $completionAction, AbstractAction $canceledAction, AbstractAction $refusalAction)
    {
        switch ($action) {
            case $completionAction->returnNameAction():
                return [self::STATUS_DONE];
            case $canceledAction->returnNameAction():
                return [self::STATUS_CANCELED];
            case $refusalAction->returnNameAction():
                return [self::STATUS_FAILED];
            default:
                return [];
        }
    }

    public function getAvailableActions($userId, AbstractAction $responseAction, AbstractAction $acceptAction, AbstractAction $canceledAction, AbstractAction $refusalAction, AbstractAction $completionAction)
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
