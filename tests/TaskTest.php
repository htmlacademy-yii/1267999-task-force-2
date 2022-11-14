<?php
/*
 * vendor/bin/phpunit --testdox / запуск теста
 */
use Models\BaseTask;
class TaskTest extends \PHPUnit\Framework\TestCase {
    public function testTransitionStatus () {
        $executorId = 100;
        $customerId = 50;
        $userId = 50;
        $status = 'new';
        $centralEntity = new BaseTask($executorId, $customerId, $userId, $status);
        $resultResponse = $centralEntity->transitionStatus($centralEntity->returnResponseAction()->returnNameAction());
        $resultCanceled = $centralEntity->transitionStatus($centralEntity->returnCanceledAction()->returnNameAction());
        $resultAccept = $centralEntity->transitionStatus($centralEntity->returnAcceptAction()->returnNameAction());
        $resultRefusal = $centralEntity->transitionStatus($centralEntity->returnRefusalAction()->returnNameAction());
        $resultCompletion = $centralEntity->transitionStatus($centralEntity->returnCompletionAction()->returnNameAction());
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
        $centralEntity = new BaseTask($executorId, $customerId, $userId, $status);
        $resultNew = $centralEntity->getAvailableActions($centralEntity->returnuserId());
        $this->assertEquals($centralEntity->returnResponseAction(), $resultNew);
    }

    public function testGetAvailableActionsCustomer () {
        $executorId = 100;
        $customerId = 50;
        $userId = 50;
        $status = 'new';
        $centralEntity = new BaseTask($executorId, $customerId, $userId, $status);
        $resultNewCustomer = $centralEntity->getAvailableActions($centralEntity->returnuserId());
        $this->assertEquals([$centralEntity->returnAcceptAction(), $centralEntity->returnCanceledAction()], $resultNewCustomer);
    }
}
