<?php
/*
 * vendor/bin/phpunit --testdox / запуск теста
 */
use taskforce\models\Task;
class TaskTest extends \PHPUnit\Framework\TestCase {
    public function testTransitionStatus () {
        $executorId = 100;
        $customerId = 50;
        $userId = 50;
        $status = 'new';
        $centralEntity = new Task($executorId, $customerId, $userId, $status);
        $resultResponse = $centralEntity->transitionStatus($centralEntity->getResponseAction()->getNameAction());
        $resultCanceled = $centralEntity->transitionStatus($centralEntity->getCanceledAction()->getNameAction());
        $resultAccept = $centralEntity->transitionStatus($centralEntity->getAcceptAction()->getNameAction());
        $resultRefusal = $centralEntity->transitionStatus($centralEntity->getRefusalAction()->getNameAction());
        $resultCompletion = $centralEntity->transitionStatus($centralEntity->getCompletionAction()->getNameAction());
        $this->assertEquals([], $resultResponse);
        $this->assertEquals([$centralEntity::STATUS_CANCELED], $resultCanceled);
        $this->assertEquals([], $resultAccept);
        $this->assertEquals([$centralEntity::STATUS_FAILED], $resultRefusal);
        $this->assertEquals([$centralEntity::STATUS_DONE], $resultCompletion);
    }

    public function testGetAvailableActionsExecutor () {
        $executorId = 100;
        $customerId = 50;
        $userId = 100;
        $status = 'new';
        $centralEntity = new Task($executorId, $customerId, $userId, $status);
        $resultNew = $centralEntity->getAvailableActions($centralEntity->getuserId());
        $this->assertEquals($centralEntity->getResponseAction(), $resultNew);
    }

    public function testGetAvailableActionsCustomer () {
        $executorId = 100;
        $customerId = 50;
        $userId = 50;
        $status = 'new';
        $centralEntity = new Task($executorId, $customerId, $userId, $status);
        $resultNewCustomer = $centralEntity->getAvailableActions($centralEntity->getuserId());
        $this->assertEquals([$centralEntity->getAcceptAction(), $centralEntity->getCanceledAction()], $resultNewCustomer);
    }
}
