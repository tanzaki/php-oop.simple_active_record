<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/14/2017
 * Time: 6:33 PM
 */
class Task{

    public static function getConnection()
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
        $connection = Task::getConnection();
        $connection->query("INSERT INTO `tasks` (`id`, `title`) VALUES (NULL, '{$this->title}');");
        $task_id = $connection->insert_id;
        echo "saving Task {$task_id} to database";
    }

    public static function find($id)
    {
        $taskArray = static::getConnection()->query("SELECT * FROM `tasks` WHERE `id` = ".$id)->fetch_assoc();
        $task = new Task();
        $task->id = $taskArray['id'];
        $task->title = $taskArray['title'];

        return $task;
    }

    public function delete()
    {
        static::getConnection()->query("DELETE FROM `tasks` WHERE `tasks`.`id` = ".$this->id);
    }
    public static function all()
    {
        $arrayTasks = static::getConnection()->query("SELECT * FROM `tasks` ORDER BY `tasks`.`id` DESC")->fetch_all(MYSQLI_ASSOC);
        //let copy this command from phpMyAdmin
        $tasks = [];
        foreach ($arrayTasks as $arrayTask){
            $task = new Task();
            $task->id = $arrayTask['id'];
            $task->title = $arrayTask['title'];
            $tasks[] = $task;
        }
        return $tasks;
    }
}
$task = new Task();
if(isset($_GET['delete_id'])){
    $task = Task::find($_GET['delete_id']);
    $task->delete();
}
if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $task->title = $title;
    $task->save();
    header('Location: .');
}
?>
<form>
    <input name="title" type="text" title="">
    <input type="submit" value="Create">
</form>
<?php
foreach (Task::all() as $task){
    echo "<li>
{$task->id}.
{$task->title}
<a href='?delete_id={$task->id}'>Delete</a>
</li>";
}
