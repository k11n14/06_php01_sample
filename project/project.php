<?php
$str = '';
$array = [];
$file = fopen('projectdata/answer_date.txt','r');
flock($file,LOCK_EX);
if($file){
  while($line = fgets($file)){
    $str .="<div>{$line}</div>";
$array[] = [
  'username'=>explode(' ',$line)[0],
  'user_question'=>str_replace("\n",'',explode(' ',$line)[1]),
  ];
  }
} 

// echo $str;

flock($file,LOCK_UN);
fclose($file);

// $filename = 'projectdata/data.txt';
// $fp = fopen($filename, 'r');
// while (!feof($fp)) {
//  $txt = fgets($fp);
//   echo $txt.'<br>';
//   }
//   fclose($fp);

$question_str = '';
$question_array = [];
$question_file = fopen('projectdata/question_data.txt','r');
flock($question_file,LOCK_EX);
if($question_file){
  while($question_line = fgets($question_file)){
    $question_str .="<div>{$question_line}</div>";
// $question_array[] = [
//   'username'=>explode(' ',$question_line)[0],
//   'user_question'=>str_replace("\n",'',explode(' ',$question_line)[1]),
//   ];

// echo $question_str;
  }
} 
flock($question_file,LOCK_UN);
fclose($question_file);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>質問！</title>
  <link rel="stylesheet" href="./css/project.css">
</head>
<body>

<form action="project_sever.php" method="POST">
  <fieldset>
<legend>質問欄</legend>
<div>
  お名前 <input type="text" name = 'user_name'>
</div>
<div>
  <!-- <textarea name=" user_question" id="question_text" cols="30" rows="10"></textarea> -->
  ご質問 <input type="text" name = 'user_question'>
</div>
<div>
  <button>送信</button>
</div>
  </fieldset>
</form>

<fieldset>
<legend>みんなの叫び</legend>
<div>ここに投稿した問題表示</div>
<div class="text_area">
<div class="question_area"><?=$question_str?></div> 
<div class="answer_area"><?=$str?></div> 
</div>
</fieldset>

<form action="project_sever.php" method="POST">
<fieldset>
  <legend>回答欄</legend>
<div>
  お名前 <input type="text" name = 'answer_name'>
</div>
<div>
  お答え <input type="text" name = 'answer_text'>
</div>
<div>
  <button>送信</button>
</div>
</fieldset>
</form>

<div id="mydiv"><p>こんにちは！</p></div>
  <script>
  
    const array = <?=json_encode($array)?>;
    console.log(array)
    console.log(array[0])
    console.log(array[0].username)
    console.log(array[0].user_question)
  document.getElementById('mydiv').innerHTML = "<p>"+array[0].username+array[0].user_question+"</p>";
</script>

</body>
</html>