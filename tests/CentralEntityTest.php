<<?php
    class CentralEntityTest extends \PHPUnit\Framework\TestCase {
        public function testTransitionStatus () {
            $executorId = 100;
            $customerId = 50;
            $centralEntity = new Class\CentralEntity($executorId, $customerId);
            $resultResponse = $centralEntity->transitionStatus($centralEntity::ACTION_RESPONSE);
            $resultCanceled = $centralEntity->transitionStatus($centralEntity::ACTION_CANCELED);
            $resultRun = $centralEntity->transitionStatus($centralEntity::ACTION_RUN);
            $resultRefusal = $centralEntity->transitionStatus($centralEntity::ACTION_REFUSAL);
            $resultCompletion = $centralEntity->transitionStatus($centralEntity::ACTION_COMPLETION);
            $this->assertEquals($centralEntity::STATUS_NEW, $resultResponse);
            $this->assertEquals($centralEntity::STATUS_NEW, $resultCanceled);
            $this->assertEquals($centralEntity::STATUS_NEW, $resultRun);
            $this->assertEquals([$centralEntity::STATUS_NEW, $centralEntity::STATUS_WORK], $resultRefusal);
            $this->assertEquals($centralEntity::STATUS_DONE, $resultCompletion);
        }

        public function testGetAvailableActions () {
            $executorId = 100;
            $customerId = 50;
            $centralEntity = new Class\CentralEntity($executorId, $customerId);

            $resultNew = $centralEntity->getAvailableActions($centralEntity::STATUS_NEW, $centralEntity->executorId);
            $resultWork = $centralEntity->getAvailableActions($centralEntity::STATUS_WORK, $centralEntity->executorId);
            $resultNewCustomer = $centralEntity->getAvailableActions($centralEntity::STATUS_NEW, $centralEntity->customerId);
            $resultWorkCustomer = $centralEntity->getAvailableActions($centralEntity::STATUS_WORK, $centralEntity->customerId);
            $this->assertEquals($centralEntity::ACTION_RESPONSE, $resultNew);
            $this->assertEquals($centralEntity::ACTION_REFUSAL, $resultWork);
            $this->assertEquals($centralEntity::ACTION_CANCELED, $resultNewCustomer);
            $this->assertEquals($centralEntity::ACTION_COMPLETION, $resultWorkCustomer);
        }
    }
