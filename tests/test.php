<?php
use taskforce\models\Task;
use taskforce\exception\StatusException;
use taskforce\exception\UserException;
require_once '../vendor/autoload.php';
try
{
    $testClass = new Task(1, 1, 1, 'new');
    $testClass->testValue();
    print_r($testClass->getAvailableActions(1));
} catch (UserException $e) {
    error_log("Не удалось обработать запрос: " . $e->getMessage());
} catch (StatusException $e) {
    error_log("Не удалось обработать запрос: " . $e->getMessage());
}

