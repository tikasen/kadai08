<?php
//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(':id', $id);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $row = $stmt->fetch(); //$row["name"]
}
?>

<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <title>ユーザ登録画面</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }

    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-defalut">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="user_list.php" class="navbar-brand">ユーザ一覧</a>
                </div>
            </div>
        </nav>
    </header>
    <form method="post" action="user_update.php" enctype="multipart/form-data">
        <div class="jumbotron">
            <fieldset>
                <legend>ユーザ登録画面</legend>
                <label>ユーザ名：<input type="text" name="u_name" value="<?=$row["name"]?>"></label>
                <BR>
                <label>ユーザーID：<input type="text" name="u_lid" value="<?=$row["lid"]?>"></label>
                <BR>
                <label>パスワード：<input type="text" name="u_lpw" value="<?=$row["lpw"]?>"></label>
                <BR>
                <input type="radio" name="kanri_flg" value="0" <?php if( empty($row['kanri_flg'])){ echo 'checked'; } ?>>スーパー管理者
                <input type="radio" name="kanri_flg" value="1" <?php if( !empty($row['kanri_flg']) && $row['kanri_flg'] === "1" ){ echo 'checked'; } ?>>管理者
                <BR>
                <input type="radio" name="life_flg" value="0" <?php if( empty($row['life_flg']) ){ echo 'checked'; } ?>>使用中
                <input type="radio" name="life_flg" value="1" <?php if( !empty($row['life_flg']) && $row['life_flg'] === "1" ){ echo 'checked'; } ?>>使用しなくなった
                <BR>
                     <input type="hidden" name="id" value="<?=$id?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>
