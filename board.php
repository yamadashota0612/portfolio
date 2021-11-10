<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>m5-1</title>
  <style>
        input{
            display:block;
            margin-bottom:10px;
        }
        
        
  </style>
</head>
<body>
<?php

//再送信防止

// （２）▼▼▼ -----------------------
// セッションスタート
session_start();
// （２）▲▲▲ ここまで --------------
 
// 初期メッセージセット
$msg = "文字を入力して送信ボタンを押してください";
 
// （４）▼▼▼ -----------------------
if ((isset($_REQUEST["name"]) == true && isset($_REQUEST["comment"]) == true)	// フォームボタンが押された？
 && (isset($_REQUEST["send"]) == true))	// 送信ボタンが押された？
{
// （４）▲▲▲ ここまで --------------
 
// （５）▼▼▼ -----------------------
	if ((isset($_REQUEST["chkno"]) == true) && (isset($_SESSION["chkno"]) == true)
	 && ($_REQUEST["chkno"] == $_SESSION["chkno"]))	// トークン番号が一致？
	{
		// 入力文字を表示
		$msg = "今入力された値は<br>【".$_REQUEST["name"]."(名前)"."と".$_REQUEST["comment"]."(コメント)"."】です。";
	}
	else
	{
		// 更新・F5ボタンによる再投稿をガード
		$msg .= "<br>更新・F5を押しても、再投稿はされません";
	}
// （５）▲▲▲ ここまで --------------
}
 
// 日付情報をセット
$today = date("Y/m/d h:i:s");
$time = "<br>■ただ今の時間[${today}]";
 
// （３）▼▼▼ -----------------------
// 新しいトークンをセット
$_SESSION["chkno"] = $chkno = mt_rand();
// （３）▲▲▲ ここまで --------------
//再送信防止








//データベース関連



$dsn = 'mysql:dbname=tb230451db;host=localhost';
$user = 'tb-230451';
$password = 'PsWpvSdCfE';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//データベースへの接続
$sql = 'DROP TABLE m5_1';

$sql = "CREATE TABLE IF NOT EXISTS m5_1"
." ("
. "id INT AUTO_INCREMENT PRIMARY KEY,"
. "name char(32),"
. "comment TEXT,"
. "time DATETIME,"
. "password TEXT"
.");";
$stmt = $pdo->query($sql);
//データベースにテーブルを作成





//データベース関連











//実行処理関連

if(!empty($_POST["delete_number"])){//削除した時の処理(削除番号が存在するとき)
    $psw = "";
    if(!empty($_POST["password_2"])){//削除番号とパスワードが存在するとき
        $psw = $_POST["password_2"];
        $delete = $_POST["delete_number"];
        
        $sql = 'SELECT * FROM m5_1';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            if($row['password'] == $psw && $row['id'] == $delete ){
                
                $id = $delete;
                $sql = 'delete from m5_1 where id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                //データレコードの削除
            }
            
     
        }
        
    
    }else{//削除番号は存在するがパスワードが存在しないとき
        echo "パスワードを入力してください";
    }
    
}elseif(!empty($_POST["password_2"])){
    echo "削除する番号を入力してください";
}else{

}

//削除ボタン押した時の処理ここまで






//送信ボタン押したときの処理ここから

if(!empty($_POST["name"])){//名前が存在するとき
    
    if(!empty($_POST["comment"])){//名前とコメントが存在するとき
    
        if(!empty($_POST["password"])){//全て存在するとき
            
            if(!empty($_POST["edit_spe"])){//編集モード

                $new_name = $_POST["name"];
                $new_com = $_POST["comment"];
                $date = date("Y/m/d H:i:s");
                $edit_spe = $_POST["edit_spe"];
                $psw = $_POST["password"];
        
                
                $sql = 'SELECT * FROM m5_1';
                $stmt = $pdo->query($sql);
                $results = $stmt->fetchAll();
                foreach ($results as $row){
                    if($row['id'] == $edit_spe){
                        $id = $edit_spe; //変更する投稿番号
                        $name = $new_name;
                        $comment = $new_com;
                        $sql = 'UPDATE m5_1 SET name=:name,comment=:comment,time=:time,password=:password WHERE id=:id';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                        $stmt->bindParam(':time', $date, PDO::PARAM_STR);
                        $stmt->bindParam(':password', $psw, PDO::PARAM_STR);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                        $stmt->execute();
                        
                        $edit_spe = "";
                    }
                }
        
            }else{//新規投稿モード
                $name = $_POST["name"];
                $com = $_POST["comment"];
                $date = date("Y/m/d H:i:s");
                $psw = $_POST["password"];
                
                
                $sql = $pdo -> prepare("INSERT INTO m5_1 (name, comment, time, password) VALUES (:name, :comment, :time, :password)");
                $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                $sql -> bindParam(':comment', $com, PDO::PARAM_STR);
                $sql -> bindParam(':time', $date, PDO::PARAM_STR);
                $sql -> bindParam(':password', $psw, PDO::PARAM_STR);
                $sql -> execute();
                

            }
            
        }else{//名前あり、コメントあり、パスワードなし
                    
            echo "パスワードを入力してください";
            
        }
        
    }elseif(!empty($_POST["password"])){//名前あり、コメントなし、パスワードあり
        
        echo "コメントを入力してください";
        
    }else{//名前あり、コメントなし、パスワードなし
        
        echo "コメントとパスワードを入力してください";
        
    }
    
}elseif(!empty($_POST["comment"])){//名前が存在しないがコメントが存在するとき
    
    if(!empty($_POST["password"])){//名前ない、コメントある、パスワードある
        
        echo "名前を入力してください";
        
    }else{//名前ない、コメントある、パスワードない
        
        echo "名前とパスワードを入力してください";
           
    }
    
}elseif(!empty($_POST["password"])){//名前ない、コメントない、パスワードある
    
    echo "名前とコメントを入力してください";
    
}else{//全てない
    
}

//送信ボタン押したときの処理ここまで






//編集ボタン押したときの処理ここから

if(!empty($_POST["edit_number"])){//編集対象番号存在するとき
    
    if(!empty($_POST["password_3"])){//パスワード存在するとき
        $edit = $_POST["edit_number"];
        $psw = $_POST["password_3"];
        
        $sql = 'SELECT * FROM m5_1';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            if($row['id'] == $edit && $row['password'] == $psw){
                $edit_name = $row['name'];
                $edit_comment = $row['comment'];
                $edit_spe = $row['id'];
            }
        }
        
    }else{//編集番号は存在するがパスワードが存在しないとき
        echo "パスワードを入力してください";
    }
}elseif(!empty($_POST["password_3"])){//編集番号は存在しないがパスワードは存在するとき
    echo "編集する番号を入力してください";
}else{//どちらも存在しないとき

}

//編集ボタン押したときの処理ここまで



//実行処理関連



$sql = 'SELECT * FROM m5_1';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
foreach ($results as $row){
    //$rowの中にはテーブルのカラム名が入る
    echo $row['id'].'<>';
    echo $row['name'].'<>';
    echo $row['comment'].'<>';
    echo $row['time'].'<br>';
    // echo $row['password'].'<br>';
echo "<hr>";
}

//データレコードを抽出して表示



?>
<form method="post" action="">
    <input type="text" name="name" placeholder="名前を入力" value = "<?php if(!empty($edit_name)){echo $edit_name ;}else{echo "";}?>">
    <input type="text" name="comment" placeholder="コメントを入力" value = "<?php if(!empty($edit_comment)){echo $edit_comment ;}else{echo "";}?>">
    <input type="hidden" name="edit_spe" placeholder="編集番号指定用" value = "<?php if(!empty($edit_spe)){echo $edit_spe ;}else{echo "";}?>">
    <input type="password" name="password" placeholder="パスワードを入力">
    <input type="submit" name="send" value="送信">
    <br>
    
    <input type="number" name="delete_number" placeholder="削除する番号を入力">
    <input type="password" name="password_2" placeholder="パスワードを入力">
    <input type="submit" name="delete" value="削除">
    <br>
    
    <input type="number" name="edit_number" placeholder="編集する番号を入力">
    <input type="password" name="password_3" placeholder="パスワードを入力">
    <input type="submit" name="edit" value="編集">
    <br>
    
    <input name="chkno" type="hidden" value="<?php echo $chkno; ?>">
    <br>
</form>
<br>
<br>
</body>
</html>
