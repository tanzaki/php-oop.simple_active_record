<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/14/2017
 * Time: 6:33 PM
 */
class Task{

}
$task = new Task();
$title = $_GET['title'];
echo $title;
?>
<form>
    <input name="title" type="text" title="">
    <input type="submit" value="Create">
</form>
