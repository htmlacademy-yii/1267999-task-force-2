<?php
use taskforce\utils\DataConversion;
use taskforce\utils\DataBase;
use taskforce\exception\SourceFileException;

use yii\db\Migration;
/**
 * Class m230403_195051_add_csv
 */
class m230403_195051_add_csv extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $loaderCategories = new DataConversion('./tests/data/categories.csv');
        $recordsCategories = [];
        try {
            $loaderCategories->import();
            $recordsCategories = $loaderCategories->getData(1);
        }
        catch (SourceFileException $e) {
            error_log("Не удалось обработать csv файл: " . $loaderCategories->getFilename() . $e->getMessage());
        }

        $loaderCities = new DataConversion('./tests/data/cities.csv');
        $recordsCities = [];
        try {
            $loaderCities->import();
            $recordsCities = $loaderCities->getData(1);
        }
        catch (SourceFileException $e) {
            error_log("Не удалось обработать csv файл: " . $loaderCities->getFilename() . $e->getMessage());
        }

        $loaderUserCategories = new DataConversion('./tests/data/user_category.csv');
        $recordsUserCategories = [];
        try {
            $loaderUserCategories->import();
            $recordsUserCategories = $loaderUserCategories->getData(1);
        }
        catch (SourceFileException $e) {
            error_log("Не удалось обработать csv файл: " . $loaderCities->getFilename() . $e->getMessage());
        }

        $loaderFiles = new DataConversion('./tests/data/files.csv');
        $recordsFiles = [];
        try {
            $loaderFiles->import();
            $recordsFiles = $loaderFiles->getData(1);
        }
        catch (SourceFileException $e) {
            error_log("Не удалось обработать csv файл: " . $loaderFiles->getFilename() . $e->getMessage());
        }

        $con = new DataBase("localhost", "root", "root", "TaskForce");
        $con->connection();
        $con->insertCities($recordsCities);
        $con->insertCategories($recordsCategories);
        $con->insertFiles($recordsFiles);
        $con->insertUserCategories($recordsUserCategories);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230403_195051_add_csv cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230403_195051_add_csv cannot be reverted.\n";

        return false;
    }
    */
}
