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
    <form method="post" action="user_insert.php" enctype="multipart/form-data">
        <div class="jumbotron">
            <fieldset>
                <legend>ユーザ登録画面</legend>
                <label>ユーザ名：<input type="text" name="u_name"></label>
                <BR>
                <label>ユーザーID：<input type="text" name="u_lid"></label>
                <BR>
                <label>パスワード：<input type="text" name="u_lpw"></label>
                <BR>
                <input type="radio" name="kanri_flg" value="0">スーパー管理者
                <input type="radio" name="kanri_flg" value="1">管理者
                <BR>
                <input type="radio" name="life_flg" value="0">使用中
                <input type="radio" name="life_flg" value="1">使用しなくなった
                <BR>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>
