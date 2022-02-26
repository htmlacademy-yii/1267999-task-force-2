<?php

    namespace models;

    class Task
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

        public $executorId = null;
        public $customerId = null;

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
            switch ($action) {
                case self::ACTION_COMPLETION:
                    return self::STATUS_DONE;
                    break;
                case self::ACTION_CANCELED:
                    return self::STATUS_CANCELED;
                    break;
                case self::ACTION_REFUSAL:
                    return self::STATUS_FAILED;
                    break;
                default:
                    return null;
            }
        }

        public function getAvailableActions($status, $userId)
        {
            switch ($status) {
                case self::STATUS_NEW:
                    if ($userId === $this->executorId) {
                        return self::ACTION_RESPONSE;
                    } elseif ($userId === $this->customerId) {
                        return [self::ACTION_RUN, self::ACTION_CANCELED];
                    }
                    break;
                case self::STATUS_WORK:
                    if ($userId === $this->executorId) {
                        return self::ACTION_REFUSAL;
                    } elseif ($userId === $this->customerId) {
                        return self::ACTION_COMPLETION;
                    }
                    break;
                default:
                    return null;
            }
        }
    }
