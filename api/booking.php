<?php

include_once "db.php";

// $movie_id=$_GET['movie_id'];
$movie=$Movie->find($_GET['movie_id']); //不是只有拿movie_id 是取得資料庫所有資料(name,...)
$date=$_GET['date'];
$session=$_GET['session'];

?>
<style>
	#room {
		background-image: url('./icon/03D04.png');
		background-position: center;
		background-repeat: none;
		width: 540px;
		height: 370px;
		margin: auto;
		box-sizing: border-box; /*設定不要被padding影響*/
		padding: 19px 112px 0 112px;

	}
	.seat {
    width: 63px;
    height: 85px;
}

.seats {
    display: flex;
    flex-wrap: wrap;
	/* background: rgba(200,200,200,0.5); */ /*測試div空間用*/
}  
</style>

<div id="room">
	<div class="seats">
		<?php
		for($i=0;$i<20;$i++){
			echo "<div class='seat'>";
			echo "<div class='ct'>";
			echo (floor($i/5)+1) . "排";
			echo (($i%5)+1) . "號";
			echo "</div>";

			echo "</div>";




		}
		?>

	</div>
</div>
	<div id="info">
		<div>您選擇的電影是:<?=$movie['name'];?></div>
		<div>您選擇的時刻是:<?=$date;?> <?=$session;?></div>
		<div>您已經勾選<span id="tickets">0</span>張票，最多可以購買四張票</div>


		<button onclick="$('#select').show();$('#booking').hide()">上一步</button>
		<button>訂購</button>
	</div>