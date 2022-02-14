<?php

class CentralEntity {
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_IN_WORK = 'in work';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';
    const ACTION_RESPONSE_TASK = 'response to a task';
    const COMPLETION_TASK = 'completion of the task';
    const REFUSAL_TASK = 'refusal of a task';
    public $idPerformer = '';
    public $idCustomer = '';
    private $map = [
        'status' => [
            self::STATUS_NEW => 'новое',
            self::STATUS_CANCELED => 'отменено',
            self::STATUS_IN_WORK => 'в работе',
            self::STATUS_DONE => 'выполнено',
            self::STATUS_FAILED => 'провалено'
        ],
        'action' => [
            self::ACTION_RESPONSE_TASK => 'отклик на задание',
            self::COMPLETION_TASK => 'завершение задания',
            self::REFUSAL_TASK => 'отказ от задания'
        ]
    ];
    public function __construct($idPerformer, $idCustomer) {
        $this->idPerformer = $idPerformer;
        $this->idCustomer = $idCustomer;
    }
    public function returnMap() {
           return $this->map;
    }
    public function transitionStatus($action) {
        $status = self::STATUS_NEW;
        if ($action === self::COMPLETION_TASK) {
            $status = self::STATUS_DONE;
        } elseif ($action === self::REFUSAL_TASK) {
            $status = [self::STATUS_NEW, self::STATUS_IN_WORK];
        }
        return $status;
    }
    public function getAvailableActions($status) {
        $action = '';
        if ($status === self::STATUS_NEW) {
            $action = [self::ACTION_RESPONSE_TASK, self::REFUSAL_TASK];
        } elseif ($status === self::STATUS_IN_WORK) {
            $action = [self::COMPLETION_TASK, self::REFUSAL_TASK];
        }
        return $action;
    }
}
