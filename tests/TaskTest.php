<<?php

    /*
     * vendor/bin/phpunit --testdox / запуск теста
     */
    class taskTest extends \PHPUnit\Framework\TestCase {
        public function testTransitionStatus () {
            $executorId = 100;
            $customerId = 50;
            $centralEntity = new models\Task($executorId, $customerId);
            $resultResponse = $centralEntity->transitionStatus($centralEntity::ACTION_RESPONSE);
            $resultCanceled = $centralEntity->transitionStatus($centralEntity::ACTION_CANCELED);
            $resultRun = $centralEntity->transitionStatus($centralEntity::ACTION_RUN);
            $resultRefusal = $centralEntity->transitionStatus($centralEntity::ACTION_REFUSAL);
            $resultCompletion = $centralEntity->transitionStatus($centralEntity::ACTION_COMPLETION);
            $this->assertEquals(null, $resultResponse);
            $this->assertEquals($centralEntity::STATUS_CANCELED, $resultCanceled);
            $this->assertEquals(null, $resultRun);
            $this->assertEquals($centralEntity::STATUS_FAILED, $resultRefusal);
            $this->assertEquals($centralEntity::STATUS_DONE, $resultCompletion);
        }

        public function testGetAvailableActions () {
            $executorId = 100;
            $customerId = 50;
            $centralEntity = new models\Task($executorId, $customerId);
            $resultNew = $centralEntity->getAvailableActions($centralEntity::STATUS_NEW, $centralEntity->executorId);
            $resultWork = $centralEntity->getAvailableActions($centralEntity::STATUS_WORK, $centralEntity->executorId);
            $resultNewCustomer = $centralEntity->getAvailableActions($centralEntity::STATUS_NEW, $centralEntity->customerId);
            $resultWorkCustomer = $centralEntity->getAvailableActions($centralEntity::STATUS_WORK, $centralEntity->customerId);
            $this->assertEquals($centralEntity::ACTION_RESPONSE, $resultNew);
            $this->assertEquals($centralEntity::ACTION_REFUSAL, $resultWork);
            $this->assertEquals([$centralEntity::ACTION_RUN,$centralEntity::ACTION_CANCELED], $resultNewCustomer);
            $this->assertEquals($centralEntity::ACTION_COMPLETION, $resultWorkCustomer);
        }
    }
