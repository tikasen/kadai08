<?php
//1. POST送信した情報を受信
$id = $_POST["id"];
$name =$_POST["u_name"];
$lid = $_POST["u_lid"];
$lpw = $_POST["u_lpw"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//３．SQLを作って送信する。
$stmt = $pdo->prepare("UPDATE gs_user_table SET name=:name,lid=:lid,lpw=:lpw,kanri_flg=:kanri_flg,life_flg=:life_flg WHERE id=:id");

$stmt->bindValue(':name',$name);
$stmt->bindValue(':lid', $lid);
$stmt->bindValue(':lpw', $lpw);
$stmt->bindValue(':kanri_flg', $kanri_flg);
$stmt->bindValue(':life_flg', $life_flg);
$stmt->bindValue(':id', $id);

$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  header("Location: user_list.php");
  exit;

}
?>
