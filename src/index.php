<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>C3.js で折れ線グラフを描画する</title>
<link href="../c3/c3.css" rel="stylesheet"><!-- c3.css を読み込む -->
</head>
<body>

<div id="my-container" style="width: 800px; height: 500px; border: solid 1px red">
  <div id="my-chart"></div>
</div>
<?php
require_once './utilities.php';
$num_data_entry = (int) $_GET['data_entry'];
// if(!$num_data_entry) $num_data_entry = 1;

// 2. DB接続します
$pdo = db_connect();

$axes = array(3,5);   //  0: x, 1: y1, 2: y2 | 0: date 1:weight 2: BMI 3: Metabolism 4: StdMetabolism
$y_label = array(2);    //  labes of y axes
foreach($axes as &$value){
    $value = "[";
}

// 2．データ登録SQL作成
// prepare("")の中にはmysqlのSQLで入力したINSERT文を入れて修正すれば良いイメージ
$stmt = $pdo->prepare("SELECT* FROM dailydata");
$status = $stmt->execute();

// loop through the returned data
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {

    // $x_axe = $x_axe . '"' . $r['date'] . '",';
    $axes[0] = $axes[0] . '"' . $r['date'] . '",';
    $axes[1] = $axes[1] . '"' . $r[$entry_sql[$num_data_entry]] . '",';
}

$axes[0] = trim($axes[0], ",");
$axes[1] = trim($axes[1], ",");
$axes[0] = $axes[0] . ']';
$axes[1] = $axes[1] . ']';

$y_label[0] = $data_entry_jp[$num_data_entry];

?>

<script src="https://d3js.org/d3.v5.min.js"></script><!-- D3.js を読み込む -->
<script src="../c3/c3.min.js"></script><!-- C3.js を読み込む -->
<script>
let chart = c3.generate({
  bindto: '#my-chart',
  size: { width: 800, height: 500 }, // グラフ描画領域のサイズ
  data: {
    columns: [
      ['データ1', 30, 200, 100, 400, 150, 250],
      ['データ2', 50, 20, 10, 40, 15, 25]
    ],
    labels: true // それぞれの点に数値を表示
  },
  axis: {
    x: {
      label: {
        text: 'X軸',
        position: 'outer-middle'
      }
    },
    y: {
      label: {
        text: 'Y軸',
        position: 'outer-middle'
      }
    }
  }
});
</script>

</body>
</html>