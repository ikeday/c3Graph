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

$num_data_entry = 1;
$axes = array();   //  0: x, 1: y1, 2: y2 | 0: date 1:weight 2: BMI 3: Metabolism 4: StdMetabolism
$y_label = array('date','weight','BMI','metabolism','stdmetabolism');    //  labes of y axes
//  daily data | 0: date 1:weight 2: BMI 3: Metabolism 4: StdMetabolism
$r = array(
    array('2020-08-11',62.3,23.0,1500,1354),
    array('2020-08-12',62.5,22.9,1523,1377),
    array('2020-08-13',62.2,22.2,1511,1365),
    array('2020-08-14',63.0,22.9,1519,1371),
    array('2020-08-16',62.8,23.2,1489,1356),
    array('2020-08-20',62.5,23.6,1495,1360),
    array('2020-08-21',62.1,23.2,1513,1376),
    );

console_log($r);
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