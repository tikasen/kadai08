<?php
//2. DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//３．SQLを作って送信する。
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//４．
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
$view .= '<p>'; 
    $view .='<a href ="userform.php?id='.$result["id"].'">';
    $view .= $result["name"]."<br>";
    $view .='</a>';
    $view .='<a href ="user_delete.php?id='.$result["id"].'">';
    $view .='[削除]';       
    $view .='</a>　'; 
    $view .='</p>';
} 
}
?>


    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ユーザ登録一覧</title>
        <link rel="stylesheet" href="css/range.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            div {
                padding: 10px;
                font-size: 16px;
            }

        </style>
    </head>

    <body id="main">
        <!-- Head[Start] -->
        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">ブックマーク</a>
                        <a class="navbar-brand" href="user_index.php">ユーザ登録</a>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Head[End] -->

        <!-- Main[Start] -->
        <div>
            <div class="container jumbotron">
                <?=$view;?>
            </div>
            <div class="container jumbotron">
                <?=$result["name"];?>
            </div>
        </div>
        <!-- Main[End] -->

    </body>

    </html>
