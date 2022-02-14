<?php
    require_once 'CentralEntity.php';
    $idPerformer = 100;
    $idCustomer = 50;
    $centralEntity = new CentralEntity($idPerformer, $idCustomer);
    assert($centralEntity->transitionStatus($centralEntity::ACTION_RESPONSE_TASK) === $centralEntity::STATUS_NEW, 'cancel action');
    assert($centralEntity->transitionStatus($centralEntity::COMPLETION_TASK) === $centralEntity::STATUS_DONE, 'cancel action');
    assert($centralEntity->transitionStatus($centralEntity::REFUSAL_TASK) === [$centralEntity::STATUS_NEW, $centralEntity::STATUS_IN_WORK], 'cancel action');
    assert($centralEntity->getAvailableActions($centralEntity::STATUS_NEW) === [$centralEntity::ACTION_RESPONSE_TASK, $centralEntity::REFUSAL_TASK], 'cancel status');
    assert($centralEntity->getAvailableActions($centralEntity::STATUS_CANCELED) === '', 'cancel status');
    assert($centralEntity->getAvailableActions($centralEntity::STATUS_IN_WORK) === [$centralEntity::COMPLETION_TASK, $centralEntity::REFUSAL_TASK], 'cancel status');
    assert($centralEntity->getAvailableActions($centralEntity::STATUS_DONE) === '', 'cancel status');
    assert($centralEntity->getAvailableActions($centralEntity::STATUS_FAILED) === '', 'cancel status');
    assert($centralEntity->idCustomer === $idCustomer, 'cancel id');
    assert($centralEntity->idPerformer === $idPerformer, 'cancel id');
