<!-- 編集機能の作成 -->

<?php


//DB接続
include('function.php');

// var_dump($_GET);
// exit();

// id受け取り
$id = $_GET['id'];

// DB接続
$pdo = connect_to_db();

// SQL実行
$sql = 'SELECT * FROM items_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($record);
// exit();


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="item-list-modal.css">
</head>

<body>

<!-- モーダルオープンのためのボタン -->
    <a id="openModalEdit" class="openModal">編集画面へ</a>
    
    <!-- モーダルエリアここから,input.phpファイルの機能と同等 -->
    <section id="modalAreaEdit" class="modalArea">   
          <form action="item-update.php" method="POST">
              <fieldset>
                <!-- <p href="item-read.php" class='item-list-p'> - 一覧画面 - </p> -->
                <!-- <br> -->
                <div>
                  <input type="text" name="item" class="item" placeholder="*商品名を修正してください" value="<?= $record['item'] ?>">
                </div>
                <br>
                <div>
                  <textarea rows=5 name="explanation" class="explanation" placeholder="＊商品の説明を記入してください"><?= $record['explanation']?></textarea>
                </div>
                <br>
                <div>
                  <input type="input" name="price" class="price" placeholder="＊金額を記入して下さい(例：10000円の場合「10000」と記入)" value="<?= $record['price']?>">
                </div>
                <br>
                <div>
                  <input type="hidden" name="id" value="<?= $record['id'] ?>">
                </div>
                <br>
                <div class="submit-button-box">
                    <button type="submit" class="resister-button">▶︎登録</button>
                </div>
                
              </fieldset>
            </form>
      
        <div id="closeModalEdit" class="closeModalEdit">
          ×
        </div>
      </div>
    </section>
    <!-- モーダルエリアここまで -->

    <!-- ↓body閉じタグ直前でjQueryを読み込む -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <!-- input用のモーダルコード -->
    <script src="item-edit-modal.js"></script>

    </form>

</body>

</html>