<?php
// こちらはサーバでの動作

// $_POSTという形でデータが送られてくる。
// その中身を確認
// echo('<pre>');
// var_dump($_POST);
// echo('</pre>');

// それぞれのデータを変数に入れ込む。
$user_name = $_POST["user_name"];
$comment =$_POST["comment"];

// それぞれのデータを入れた変数を一つの$input_all_dateという変数にまとめる。
//↓と書き方が違うだけ
//  $input_all_date =$_POST["user_name"].$_POST["comment"];
$input_all_date ="{$_POST["user_name"]} {$_POST["comment"]}\n";
// echo $input_all_date;

// 書き込み専用で'develop_database/todo.txt'を開く。
$file = fopen('develop_database/su-sann.txt','a');
// ファイルをロックする
flock($file,LOCK_EX);

// 書き込み専用で開いた'develop_database/todo.txt'に$input_all_dateを書き込む。
fwrite($file,$input_all_date);

// ファイルをアンロックする
flock($file,LOCK_UN);
// ファイルを閉じる。
fclose($file);

// develop_input.phpに戻る。
header('Location:develop_input.php')


?>
