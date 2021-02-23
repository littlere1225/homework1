<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	</head>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/captcha.css">
<body>
<!-- <form action="index_action.php" onsubmit="return validateForm();"  method="POST"> -->
    <form action="index_action.php" method="POST">
        <div class="p-5">
						<div class="form-group">
                <label for="name">聯絡人姓名/Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="請輸入聯絡姓名">
            </div>
						<div class="form-group">
                <label for="company">公司名稱/Company</label>
                <input type="text" class="form-control" name="company" id="company" placeholder="請輸入公司/單位名稱">
            </div>
            <div class="form-group">
                <label for="email"><span class="text-danger">*</span>電子郵件/E-mail</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="請輸入E-mail" required>
            </div>
						<div class="form-group">
                <label for="messages">聯絡事項/Messages</label>
                <textarea type="text" class="form-control" name="messages" id="messages"></textarea>
            </div>
            <div class="form-group mb-0">
                <label><span class="text-danger">*</span>驗證碼</label>
            </div>
            <div class="form-inline">
                <div class="form-group mb-0">
                    <label class="sr-only">驗證碼</label>
                    <input type="text" name="checkword" class="form-control" id="codeinput" placeholder="請輸入下圖字樣" required>
                </div>
                <img id="imgcode" src="captcha.php" class="ml-3" onclick="refresh_code()" />
            </div>
            <small class="form-text text-muted"><span class="text-danger">*</span>點擊圖片可以更換驗證碼,有大小寫之分</small>
            <button type="submit" class="btn btn-primary btn-sm btn_w">送出</button>
        </div>
    </form>

    <script>
        function refresh_code(){ 
            document.getElementById("imgcode").src = "captcha.php"; 
        } 
    </script>
    
</body>
</html>