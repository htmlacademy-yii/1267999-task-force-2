<?php

    namespace Class;

    class CentralEntity
    {
        const STATUS_NEW = 'new';
        const STATUS_CANCELED = 'canceled';
        const STATUS_WORK = 'work';
        const STATUS_DONE = 'done';
        const STATUS_FAILED = 'failed';

        const ACTION_RESPONSE = 'response';
        const ACTION_CANCELED = 'canceled';
        const ACTION_RUN = 'run';
        const ACTION_REFUSAL = 'refusal';
        const ACTION_COMPLETION = 'completion';

        public $executorId = '';
        public $customerId = '';

        private $map = [
            'status' => [
                self::STATUS_NEW => 'новое',
                self::STATUS_CANCELED => 'отменено',
                self::STATUS_WORK => 'в работе',
                self::STATUS_DONE => 'выполнено',
                self::STATUS_FAILED => 'провалено'
            ],
            'action' => [
                self::ACTION_RESPONSE => 'откликнутьcя',
                self::ACTION_CANCELED => 'отменить',
                self::ACTION_RUN => 'запустить',
                self::ACTION_REFUSAL => 'отказаться',
                self::ACTION_COMPLETION => 'завершить'
            ]
        ];

        public function __construct($executorId, $customerId)
        {
            $this->executorId = $executorId;
            $this->customerId = $customerId;
        }

        public function returnMap()
        {
            return $this->map;
        }

        public function transitionStatus($action)
        {
            $status = self::STATUS_NEW;
            if ($action === self::ACTION_COMPLETION) {
                $status = self::STATUS_DONE;
            } elseif ($action === self::ACTION_REFUSAL) {
                $status = [self::STATUS_NEW, self::STATUS_WORK];
            }
            return $status;
        }

        public function getAvailableActions($status, $idUser)
        {
            $action = '';
            if ($idUser === $this->executorId) {
                if ($status === self::STATUS_NEW) {
                    $action = self::ACTION_RESPONSE;
                } elseif ($status === self::STATUS_WORK) {
                    $action = self::ACTION_REFUSAL;
                }
            } elseif ($idUser === $this->customerId) {
                if ($status === self::STATUS_NEW) {
                    $action = self::ACTION_CANCELED;
                } elseif ($status === self::STATUS_WORK) {
                    $action = self::ACTION_COMPLETION;
                }
            }
            return $action;
        }
    }
