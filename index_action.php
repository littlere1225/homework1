<?php
	//導回首頁的功能
	$script = <<<HTML
	<script>
	//  function show_confirm(text){
	// 	 var r = confirm(text);
	// 	 var backurl = './index.html';
	// 	 if (r == true){
	// 		 window.open(backurl, '_blank');
	// 	 }else{
	// 			window.open(backurl, '_blank');
	// 	 }
	//  }
	function show_confirm(text){
		 var r = confirm(text);
		 var backurl = './index.html';
		 if (r == true){
			 window.open(backurl,'_parent');
		 }else{
				window.open(backurl,'_parent');
		 }
	 }
	</script>
HTML;

if(!isset($_SESSION)){
    session_start();
    }  //判斷session是否已啟動

	 //$_SESSION['check_word'] 設置存放檢查碼的SESSION
	 //$_POST['checkword'] 前面輸入的驗證碼
	 // isset判斷的是 "變數, empty判斷的是 "值"
	 
if((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))){  //判斷此兩個變數是否為空
    
     if($_SESSION['check_word'] == $_POST['checkword']){         
          $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值         
					header('content-Type: text/html; charset=utf-8');								         
          //echo $script.'<script>show_confirm("OK輸入正確，將於一秒後跳轉");</script>';
					//echo '<meta http-equiv="refresh" content="1; url=./index.html">';      

				//檢查是否被輸入特殊字元與網址
				$standard_G_2 = "/^[\w]*@[\w-]+(\.[\w-]+)+$/" ;
				$symbolcheck = "/http\:\/\/|echo|&[\w-]|<|>/i";
				//文字提示
				$description = '因為此表單被輸入非法字元,所以資料已剃除，如果有問題可聯絡客服';

				function checkString($standard,$strings){
						if(preg_match($standard, $strings, $hereArray)) {
								return 1;
								//抓到
						} else {       
								return $strings;
								//沒抓到              
						}
				}
				

				//存放前端表單 input name
				$inputarray = array("name","company","email","messages");
				$inputlength = count($inputarray);
				//存放資料
				$stack = array();

				

				//1.取得input資料
				//2.判斷是否有備輸入特殊字元與網址
				for( $i= 0; $i<$inputlength; $i++ ){

						$stack[$i] = checkString($symbolcheck,$_POST[$inputarray[$i]]);
						if ( checkString($symbolcheck,$_POST[$inputarray[$i]]) != 1 ){
								$stack[$i] = $_POST[$inputarray[$i]];
						}else{
								$stack[$i] = $description;
						}
												
				}

				

				//寄信
				if ( $_POST['name'] != '' && $_POST['email'] != '' && $_POST['messages'] != '' ){

					$inputtitle = array("聯絡人姓名/Name","公司名稱/Company","電子郵件/E-mail","聯絡事項/Messages");
					$length = count($inputtitle);
					$weburl = 'www.google.com.tw';
					$copyright = 'XXXX公司';
					
					$messageslist = '';
			
					for ( $i=0 ; $i<$length; $i++ ) {
							$messageslist .= '
							<p style="border-bottom: solid 1px #DDD;padding: 2px 10px; border-radius: 2px; color: #9e9e9e;">'.$inputtitle[$i].'</p>
							<p style="padding: 2px 10px;">'.$stack[$i].'</p>
							';
					}
			
					$content = '
					<div style="width:800px; max-width:95%; margin:0 auto;">
							<h2 style=" font-size:18px; padding: 10px 10px; color:#FFF; background:#303030; margin-bottom: 0; border-top-left-radius:5px; border-top-right-radius:5px;">網站聯絡我們通知信</h2>
							<div style="padding: 0px 10px 5px 10px; border: solid 1px #EEE;">      
									'.$messageslist.'
							</div>
							<div style="font-size: 12px;  padding: 5px 10px;">
									<a href="http://'.$weburl.'" target="_blank" style="text-decoration: none; margin-right: 10px;">網址：'.$weburl.'</a>
									<span>Copyright © '.$copyright.'</span>
							</div>  
					</div>
					';
			

					$nickname=$_POST['name'];
					$email=$_POST['email'];
					$sub= '網站聯絡我們通知信';

					mb_internal_encoding("utf-8");
					$to="littlere1225@gmail.com";//填入自己的電子信箱
					$subject=mb_encode_mimeheader("$sub","utf-8");
					$message="$content";
					$headers="MIME-Version: 1.0\r\n";
					$headers.="Content-type: text/html; charset=utf-8\r\n";
					$headers.="From:".mb_encode_mimeheader("$nickname","utf-8")."<$email>\r\n";
					mail($to,$subject,$message,$headers);
					echo $script.'<script>show_confirm("發送成功");</script>';
					//echo $to,$subject,$message,$headers;
					
				}else{
					header('content-Type: text/html; charset=UTF-8');
         	echo $script.'<script>show_confirm("您有必填項目未填寫");</script>';
				}



				
					exit();
     }else{
        header('content-Type: text/html; charset=utf-8');
         echo $script.'<script>show_confirm("Error輸入錯誤，將於一秒後跳轉");</script>';
         //echo '<meta http-equiv="refresh" content="1; url=./index.html">';
     }

}else{
		header('content-Type: text/html; charset=utf-8');
		echo "錯誤操作，將於一秒後跳轉";
		echo '<meta http-equiv="refresh" content="1; url=./index.html">';
}
?>
