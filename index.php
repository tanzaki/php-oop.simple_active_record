<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/14/2017
 * Time: 6:33 PM
 */
class Task{

    public function getConnection()
    {
        $host = 'localhost';//point to same server <XAMPP>
        $username = 'root'; //XAMPP default
        $password = '';     //XAMPP default is no password
        $database = 'test'; //XAMPP default
        $connect = new mysqli($host,$username,$password,$database);
        return $connect;
    }
    public function save()
    {
        $connection = $this->getConnection();
        $connection->query("INSERT INTO `tasks` (`id`, `title`) VALUES (NULL, '{$this->title}');");
        $task_id = $connection->insert_id;
        echo "saving Task {$task_id} to database";
    }
}
$task = new Task();
$title = $_GET['title'];
$task->title = $title;
$task->save();
?>
<form>
    <input name="title" type="text" title="">
    <input type="submit" value="Create">
</form>
