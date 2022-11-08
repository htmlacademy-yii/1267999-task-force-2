<<?php

    /*
     * vendor/bin/phpunit --testdox / запуск теста
     */
    class TaskTest extends \PHPUnit\Framework\TestCase {
        public function testTransitionStatus () {
            $executorId = 100;
            $customerId = 50;
            $status = 'new';
            $centralEntity = new models\Task($executorId, $customerId, $status);
            $resultResponse = $centralEntity->transitionStatus($centralEntity::ACTION_RESPONSE);
            $resultCanceled = $centralEntity->transitionStatus($centralEntity::ACTION_CANCELED);
            $resultRun = $centralEntity->transitionStatus($centralEntity::ACTION_RUN);
            $resultRefusal = $centralEntity->transitionStatus($centralEntity::ACTION_REFUSAL);
            $resultCompletion = $centralEntity->transitionStatus($centralEntity::ACTION_COMPLETION);
            $this->assertEquals([], $resultResponse);
            $this->assertEquals([$centralEntity::STATUS_CANCELED], $resultCanceled);
            $this->assertEquals([], $resultRun);
            $this->assertEquals([$centralEntity::STATUS_FAILED], $resultRefusal);
            $this->assertEquals([$centralEntity::STATUS_DONE], $resultCompletion);
        }

        public function testGetAvailableActions () {
            $executorId = 100;
            $customerId = 50;
            $status = 'new';
            $centralEntity = new models\Task($executorId, $customerId, $status);
            $resultNew = $centralEntity->getAvailableActions($centralEntity->executorId);
            $resultNewCustomer = $centralEntity->getAvailableActions($centralEntity->customerId);
            $this->assertEquals([$centralEntity::ACTION_RESPONSE], $resultNew);
            $this->assertEquals([$centralEntity::ACTION_RUN,$centralEntity::ACTION_CANCELED], $resultNewCustomer);
        }
    }
