<?php
$str = '';

// ファイルを開く（’develop_database/todo.txt’という,'読み込みのみで'）；
$file = fopen('develop_database/todo.txt','r');
// （$file＝『読み込み専用で開いた’develop_database/todo.txt’』をロックする）；
flock($file,LOCK_EX);

// ↓だと'develop_database/todo.txt'の一行目だけしか読み取り出来ない
// $read_date= fgets($file);
// echo $read_date;
if($file){
  while($line = fgets($file)){
  $str .="<div>{$line}</div>";
  }
}
// var_dump($str);

// （$file＝『読み込み専用で開いた’develop_database/todo.txt’』をアンロックする）；
flock($file,LOCK_UN);
// 開いていたファイルを閉じる。
fclose($file);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>入力画面</title>
</head>
<body>
  <form action="develop_sever.php" method="POST">
    <fieldset>
      <legend>入力フォーラム</legend>
      <div>
        名前＊ <input type ='text' name = 'user_name'>
      </div>
      <div>
        コメント＋ <input type ='text' name = 'comment'>
      </div>
      <div>
        <button>送信</button>
      </div>
    </fieldset>
  </form>
  <div class="F">
    
    </div>
    <div class="S">
    <?=$str?>
  </div>
</body>
</html>