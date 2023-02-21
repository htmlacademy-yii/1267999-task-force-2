<?php
use taskforce\models\Task;
use taskforce\utils\DataConversion;
use taskforce\utils\DataBase;
use taskforce\exception\StatusException;
use taskforce\exception\UserException;
use taskforce\exception\FileFormatException;
use taskforce\exception\SourceFileException;
use taskforce\exception\DataBaseException;

require_once '../vendor/autoload.php';
//try
//{
//    $testClass = new Task(1, 1, 1, 'new');
//    $testClass->testValue();
//    print_r($testClass->getAvailableActions(1));
//} catch (UserException $e) {
//    error_log("Не удалось обработать запрос: " . $e->getMessage());
//} catch (StatusException $e) {
//    error_log("Не удалось обработать запрос: " . $e->getMessage());
//}


$loaderCategories = new DataConversion('../data/categories.csv');
$recordsCategories = [];
try {
    $loaderCategories->import();
    $recordsCategories = $loaderCategories->getData(1);
}
catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $loaderCategories->getFilename() . $e->getMessage());
}

$loaderCities = new DataConversion('../data/cities.csv');
$recordsCities = [];
try {
    $loaderCities->import();
    $recordsCities = $loaderCities->getData(1);
}
catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $loaderCities->getFilename() . $e->getMessage());
}

$loaderFiles = new DataConversion('../data/files.csv');
$recordsFiles = [];
try {
    $loaderFiles->import();
    $recordsFiles = $loaderFiles->getData(1);
}
catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $loaderFiles->getFilename() . $e->getMessage());
}

$loaderReviews = new DataConversion('../data/reviews.csv');
$recordsReviews = [];
try {
    $loaderReviews->import();
    $recordsReviews = $loaderReviews->getData(1);
}
catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $loaderReviews->getFilename() . $e->getMessage());
}

$loaderTasks = new DataConversion('../data/task.csv');
$recordsTasks = [];
try {
    $loaderTasks->import();
    $recordsTasks = $loaderTasks->getData(1);
}
catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $loaderTasks->getFilename() . $e->getMessage());
}

$loaderUsers = new DataConversion('../data/user.csv');
$recordsUsers = [];
try {
    $loaderUsers->import();
    $recordsUsers = $loaderUsers->getData(1);
}
catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $loaderUsers->getFilename() . $e->getMessage());
}


$loaderUserCategories = new DataConversion('../data/user_category.csv');
$recordsUserCategories = [];
try {
    $loaderUserCategories->import();
    $recordsUserCategories = $loaderUserCategories->getData(1);
}
catch (SourceFileException $e) {
    error_log("Не удалось обработать csv файл: " . $loaderCities->getFilename() . $e->getMessage());
}

$con = new DataBase("localhost", "root", "root", "TaskForce");
$con->connection();
$con->insertCities($recordsCities);
$con->insertCategories($recordsCategories);
$con->insertFiles($recordsFiles);
$con->insertUsers($recordsUsers);
$con->insertTasks($recordsTasks);
$con->insertUserCategories($recordsUserCategories);
$con->insertReviews($recordsReviews);




