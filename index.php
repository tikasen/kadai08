<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <title>ブックマーク</title>
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
                    <a href="user_list.php" class="navbar-brand">ユーザ一覧画面</a>
                </div>
            </div>
        </nav>
    </header>
    <?php
    //DB接続
    try {
        $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    }catch (PDOException $e){
        exit('DbConnectError:'.$e->getMessage());
    }
    $view="";
    
    //SQLからの送信
    $stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY t_time DESC");
    $status = $stmt->execute();
    
    //値の判定
    if($status==false){
        $error = $stmt->errorInfo();
        exit("QueryError:".$error[2]);
        
    }else{
        while($result =$stmt->fetch(PDO::FETCH_ASSOC)){
            $view .='<p>';
            $view .=$result["t_time"].':'. $result["b_name"];
            $view .='</p>';
        }
    }
?>
        <form method="post" action="insert.php" enctype="multipart/form-data">
            <div class="container jumbotron">
                <?=$view;?>
            </div>

            <div class="jumbotron">
                <fieldset>
                    <legend>本のブックマーク</legend>
                    <label>書籍名：<input type="text" name="b_name"></label>
                    <BR>
                    <label>書籍URL：<input type="text" name="b_url"></label>
                    <BR>
                    <label>書籍コメント：<input type="text" name="b_comment"></label>
                    <input type="submit" value="送信">

                </fieldset>
            </div>
        </form>
</body>

</html>
