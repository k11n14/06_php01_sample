<?php
// まずは`var_dump($_POST);`で値を確認！！
var_dump($_POST);
// exit();


// データの受け取り
$todo =$_POST["todo"];
$deadline =$_POST["deadline"];
// echo $todo;
// echo $deadline;
// var_dump($todo)

// データ1件を1行にまとめる（最後に改行を入れる）
$write_date = "{$todo} {$deadline}\n";

// ファイルを開く．引数が`a`である部分に注目！
// $file = fopen("date/todo.txt","a");
// $file = fopen('date/todo.txt','a');
$file = fopen('data/todo.txt', 'a');

// ファイルをロックする
flock($file,LOCK_EX);

// 指定したファイルに指定したデータを書き込む
fwrite($file,$write_date);

// ファイルのロックを解除する
flock($file,LOCK_UN);

// ファイルを閉じる
fclose($file);

// データ入力画面に移動する
header("Location:todo_txt_input.php")



?>