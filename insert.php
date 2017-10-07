<?php

//1. POST送信した情報を受信
$b_name = $_POST["b_name"];
$b_url = $_POST["b_url"];
$b_comment = $_POST["b_comment"];

//2. DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．SQLを作って送信する。
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, b_name, b_url, b_comment,t_time )VALUES(NULL, :b_name, :b_url, :b_comment, sysdate())");
$stmt->bindValue(':b_name', $b_name, PDO::PARAM_STR);
$stmt->bindValue(':b_url', $b_url, PDO::PARAM_STR);
$stmt->bindValue(':b_comment', $b_comment, PDO::PARAM_STR);
//$stmt->bindValue(':img_name', $file_name, PDO::PARAM_STR);

$status = $stmt->execute();

//４．
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
  
}else{
  header("Location: ./index.php");
  exit;

}
?>
