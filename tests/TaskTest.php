<?php
/*
 * vendor/bin/phpunit --testdox / запуск теста
 */
use models\BaseTask;
use models\AbstractAction;
use models\AcceptAction;
use models\CanceledAction;
use models\CompletionAction;
use models\RefusalAction;
use models\ResponseAction;

class TaskTest extends \PHPUnit\Framework\TestCase {
    public function testTransitionStatus () {
        $executorId = 100;
        $customerId = 50;
        $userId = 50;
        $status = 'new';
        $centralEntity = new BaseTask($executorId, $customerId, $userId, $status);
        $resultResponse = $centralEntity->transitionStatus($centralEntity->responseAction->returnNameAction(), $centralEntity->completionAction, $centralEntity->canceledAction, $centralEntity->refusalAction);
        $resultCanceled = $centralEntity->transitionStatus($centralEntity->canceledAction->returnNameAction(), $centralEntity->completionAction, $centralEntity->canceledAction, $centralEntity->refusalAction);
        $resultAccept = $centralEntity->transitionStatus($centralEntity->acceptAction->returnNameAction(), $centralEntity->completionAction, $centralEntity->canceledAction, $centralEntity->refusalAction);
        $resultRefusal = $centralEntity->transitionStatus($centralEntity->refusalAction->returnNameAction(), $centralEntity->completionAction, $centralEntity->canceledAction, $centralEntity->refusalAction);
        $resultCompletion = $centralEntity->transitionStatus($centralEntity->completionAction->returnNameAction(), $centralEntity->completionAction, $centralEntity->canceledAction, $centralEntity->refusalAction);
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
        $resultNew = $centralEntity->getAvailableActions($centralEntity->userId, $centralEntity->responseAction, $centralEntity->acceptAction, $centralEntity->canceledAction, $centralEntity->refusalAction, $centralEntity->completionAction);
        $this->assertEquals($centralEntity->responseAction, $resultNew);
    }

    public function testGetAvailableActionsCustomer () {
        $executorId = 100;
        $customerId = 50;
        $userId = 50;
        $status = 'new';
        $centralEntity = new BaseTask($executorId, $customerId, $userId, $status);
        $resultNewCustomer = $centralEntity->getAvailableActions($centralEntity->userId, $centralEntity->responseAction, $centralEntity->acceptAction, $centralEntity->canceledAction, $centralEntity->refusalAction, $centralEntity->completionAction);
        $this->assertEquals([$centralEntity->acceptAction, $centralEntity->canceledAction], $resultNewCustomer);
    }
}
