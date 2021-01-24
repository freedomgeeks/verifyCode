<?php
if(isset($_REQUEST['authcode'])){

    session_start();

    if(strtolower($_REQUEST['authcode'])==$_SESSION['verifyCode']){
         echo '<font color="#0000CC">验证码输入正确</font>';

    }else{
        echo '<font color="#CC0000"><b>验证码输入错误</b></fotn>';

    }
    exit();
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Document</title>
</head>

    <body>
         <form method="post" action="./form.php">
                        图片验证码: <img  id="captcha_img"border="1" src="captchaCode.php?r=<?= rand();?>"width='100'/>
            <a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='./captchaCode.php?r='+Math.random()">换一个？</a>

            <p>请输入图片中的验证码: <input type="text" name="authcode" value="" /></p>
            <p><input type="submit" value="提交" style="padding:6px 20px;" /></p>
        </form>
    </body>
</html>












