<?php

include_once "db.php";

// $movie_id=$_GET['movie_id'];
$movie=$Movie->find($_GET['movie_id']); //不是只有拿movie_id 是取得資料庫所有資料(name,...)
$date=$_GET['date'];
$session=$_GET['session'];

$ords=$Order->all(['movie'=>$movie['name'],
                   'date'=>$date,
				   'session'=>$session]);
$seats=[]; //宣告一個空陣列
foreach($ords as $ord){
	$tmp=unserialize($ord['seats']);
	$seats=array_merge($seats,$tmp); //多個陣列合併為單一陣列 檢查一遍就好
}


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
    width: 63px; /*這邊是在ps確認圖面寬高 並在畫面上測試調整*/
    height: 85px;
	position:relative;
}

.seats {
    display: flex;
    flex-wrap: wrap;
	/* background: rgba(200,200,200,0.5); */ /*測試div空間用*/
}
.chk{
	position:absolute;
	right:2px;
	bottom:2px;
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
			echo "<div class='ct'>";
			if(in_array($i,$seats)){
			echo "<img src='./icon/03D03.png'>";
		}else{
			echo "<img src='./icon/03D02.png'>";
		}
		echo "</div>";
		if(!in_array($i,$seats)){
			echo "<input type='checkbox' name='chk' value='$i' class='chk'>"; //使用!not去判斷 有座位的就不需再寫else的做法
		}
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
		<button onclick="checkout()">訂購</button>
	</div>

	<script>
		let seats=new Array(); //在外宣告全域陣列

		$('.chk').on('change',function(){ //這邊使用change instead of click 因為是要看"勾選了"這個變化(change)
			if($(this).prop('checked')){
				if(seats.length+1<=4){
					seats.push($(this).val())
				}else{
					$(this).prop('checked',false)
					alert('每個人只能勾選四張票')
				}

			}else{
				seats.splice(seats.indexOf($(this).val()),1) //從seats 用indexOf找被勾選的"位置" 然後取那筆刪除
			}
			$('#tickets').text(seats.length)
			// console.log($(this).prop('checked'),seats)

		})
		function checkout(){
			$.post("./api/checkout.php",{movie:'<?=$movie['name'];?>',
				                         date:'<?=$date;?>',
										 session:'<?=$session;?>',
										 qt:seats.length //先把點選的座位數量傳送
										 ,seats},(no)=>{
				location.href=`?do=result&no=${no}`; //注意取得的值要改成字串(加' ') 不然輸入資料庫會有問題(變變數)

			})

			
		}
	</script>