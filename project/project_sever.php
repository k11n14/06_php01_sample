<?php
echo('<pre>');
var_dump($_POST);
echo('</pre>');

$user_name = $_POST["user_name"];
$user_c =$_POST["user_question"];
$answer_name =$_POST["answer_name"];
$answer_text =$_POST["answer_text"];

$input_question_data ="{$_POST["user_name"]} {$_POST["user_question"]}\n";

$input_answer_date ="{$_POST["answer_name"]} {$_POST["answer_text"]}\n";


$question_file = fopen('projectdata/question_data.txt','a');
flock($question_file,LOCK_EX);
fwrite($question_file,$input_question_data);
flock($question_file,LOCK_UN);
fclose($question_file);

$answer_file = fopen('projectdata/answer_date.txt','a');
flock($answer_file,LOCK_EX);
fwrite($answer_file,$input_answer_date);
flock($answer_file,LOCK_UN);
fclose($answer_file);

header('Location:project.php')


?>