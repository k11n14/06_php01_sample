<?php
// ここはサーバーからデータを取ってくる動作

// 空の変数
$str = '';

echo('<pre>');
var_dump($str);
echo($str);
echo('</pre>');


// 空の配列
$array = [];

// 配列みたいになっているか確認する。
echo('<pre>');
var_dump($array);
// echo($array);←echoは値にしか使えないので配列に使うとエラーが出る。
echo('</pre>');


// ファイルを開く（’develop_database/todo.txt’という,'読み込みのみで'）；
$file = fopen('develop_database/todo.txt','r');
// （$file＝『読み込み専用で開いた’develop_database/todo.txt’』をロックする）；
flock($file,LOCK_EX);

// ↓だと'develop_database/todo.txt'の一行目だけしか読み取り出来ない
// $read_date= fgets($file);

// if(ファイルが開けたなら){
if($file){
  //   while『し続ける』（$line= 一行読み取る。($file)から) ）{
  while($line = fgets($file)){
    // $strに .=文字列を足す。それは"<div>{$line}</div>"；
  $str .="<div>{$line}</div>";
// phpの配列の短縮構文
// explode(' 'の部分で区切った,$lineという文字列の)[0]の番目、
  $array[] = [
  'username'=>explode(' ',$line)[0],
  // str_replace置き換える("\n"という文字を,''に,explode(' ',$line)[2]の中にある)
  'comment'=>explode(' ',$line)[1],
  // 入力欄として存在しないためにコメントアウト
  // 'date'=> str_replace("\n",'',explode(' ',$line)[2])
];
}
}
// var_dump($str);
echo('<pre>');
var_dump($array);
echo('</pre>');


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

  <script>
    const array = <?=json_encode($array)?>;
    console.log(array)
  </script>
  <div>Gitテスト</div>
</body>
</html>