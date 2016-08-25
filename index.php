<?php
// この一行で取れちゃいます
$lastDay = intval(date('t'));

// 月初の文字列を取得する
// 表示する年月が"2016年8月"とした場合、以下で取得されるのは"2016-8-1"です
$currentMonth = date('Y-n-1');

// 上記の日付から曜日を取得する
// "2016-8-1"は月曜日ですので1になります
// なお曜日の意味は0:日曜日～6:土曜日です
$firstWeekDay = date('w', strtotime($currentMonth));

// 週毎に日付を入れる配列を作成する
$weekDays = [];

// 1日が始まる曜日までnullで埋める
// 最初の週は途中の曜日から始まる場合があるので
// 日付が無いことを表すためにnullを代入する
for ($i = 0; $i < $firstWeekDay; $i++) {
    $weekDays[0][] = null;
}

// 1日が始まる曜日以降を処理する
$weekNumber = 0;
foreach (range(1, $lastDay) as $day) {
    $weekDays[$weekNumber][] = $day;

    // 週の土曜日を処理したら日曜日に戻して次週にする
    if (count($weekDays[$weekNumber]) == 7) {
        // 週を表す変数を加算する
        $weekNumber++;
    }
}

// 最後の週を7日間の配列にする
if (count($weekDays[$weekNumber]) < 7) {
    for ($i = count($weekDays[$weekNumber]) - 1; $i < 6; $i++) {
        $weekDays[$weekNumber][] = null;
    }
}
// ここまでで配列はキレイにカレンダーのように表示できます
?>

<!-- ここからPHPで処理する -->
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>カレンダーアプリ</title>
        <style type="text/css">
        table {
            border-collapse: collapse;
            border: 1px solid #ccc;
        }
        th, td {
            border: 1px solid #ccc;
            text-align: center;
        }
        </style>
    </head>
    <body>
        <div style="width:200px;text-align:center;font-size:24px;"><?php echo date('Y年n月');?></div>
        <table style="width:200px;">
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
            <!-- ここからPHPで処理する -->
<?php foreach ($weekDays as $week): ?>
    <?php foreach ($week as $weekNum => $day): ?>
        <?php if ($weekNum === 0):?>
            <tr>
        <?php endif;?>
                <td><?php echo $day;?></td>
        <?php if ($weekNum === 6): ?>
            </tr>
        <?php endif;?>
    <?php endforeach;?>
<?php endforeach;?>
            <!-- ここまでPHPで処理する -->
        </table>
    </body>
</html>
