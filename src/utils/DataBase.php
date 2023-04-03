<?php

namespace taskforce\utils;

use mysqli;
use mysqli_sql_exception;

class DataBase
{
    protected $hostname = null;
    protected $username = null;
    protected $password = null;
    protected $database = null;
    protected $con = null;


    public function __construct($hostname, $username, $password, $database)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connection() {
        try {
            $this->con = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        }
        catch (mysqli_sql_exception $exception) {
            throw new mysqli_sql_exception("Не удалось установить соединение с базой данных");
        }
        mysqli_set_charset($this->con, "utf8");
    }

    public function insertCategories($categories)
    {
        foreach ($categories as $category) {
            $stmt = $this->con->prepare("INSERT INTO categories(name, code) VALUES (?, ?)");
            $stmt->bind_param("ss", $category[0], $category[1]);
            $stmt->execute();
        }
    }

    public function insertCities($cities)
    {
        $recordsCities = [];
        foreach ($cities as $key=>$value) {
            $translit = (string) $value[0];
            $translit = trim($translit);
            $translit = strtr($translit, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
            $recordsCities[$key] = [$value[0], $translit, $value[1], $value[2]];
        }
        foreach ($recordsCities as $city) {
            $stmt = $this->con->prepare("INSERT INTO cities(name, code, coordinates) VALUES (?, ?, POINT(?,?))");
            $stmt->bind_param("ssdd", $city[0], $city[1], $city[2], $city[3]);
            $stmt->execute();
        }
    }

    public function insertFiles($files)
    {
        foreach ($files as $file) {
            $stmt = $this->con->prepare("INSERT INTO files(path) VALUES (?)");
            $stmt->bind_param("s", $file[0]);
            $stmt->execute();
        }
    }

    public function insertUsers($users)
    {
        foreach ($users as $user) {
            $stmt = $this->con->prepare("INSERT INTO users(city_id, name, email, password, rating, created_at, role, birthday, phone, telegram, information, avatar_file_id, done_orders, failed_orders, place_rank) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isisisissssiiii", $user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8], $user[9], $user[10], $user[11], $user[12], $user[13], $user[14]);
            $stmt->execute();
        }
    }

    public function insertTasks($tasks)
    {
        foreach ($tasks as $task) {
            $stmt = $this->con->prepare("INSERT INTO tasks(category_id, user_id, city_id, coordinates, status, name, details, budget, deadline, file_id, created_at, address) VALUES (?, ?, ?, POINT(?, ?), ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiddissisiss", $task[0], $task[1], $task[2], $task[3], $task[4], $task[5], $task[6], $task[7], $task[8], $task[9], $task[10], $task[11], $task[12]);
            $stmt->execute();
        }
    }

    public function insertReviews($reviews)
    {
        foreach ($reviews as $review) {
            $stmt = $this->con->prepare("INSERT INTO reviews(task_id, customer_id, created_at, executor_id, rating, comment) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisiis", $review[0], $review[1], $review[2], $review[3], $review[4], $review[5]);
            $stmt->execute();
        }
    }

    public function insertUserCategories($categories)
    {
        foreach ($categories as $category) {
            $stmt = $this->con->prepare("INSERT INTO users_categories(user_id, category_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $category[0], $category[1]);
            $stmt->execute();
        }
    }
}