<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Mail Gönder</title>
<script type="text/javascript" src="http://www.ziveralyans.com/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="http://www.ziveralyans.com/ckeditor/_samples/sample.js"></script>
<script type="text/javascript" src="http://www.ziveralyans.com/ckeditor/_samples/sample.css"></script>
</head>
<body>
	<form action="" method="post">
		<label>Adınız <br>
		<input type="text" name="adsoyad" />
		</label><br>
		<label>Eposta <br>
		<input type="mail" name="eposta" />
		</label><br>
		</label><br>
		<label>Mesaj <br>
<?php
$github_test="Github";
include_once '../ckeditor/ckeditor.php' ;
require_once '../ckfinder/ckfinder.php' ;
$initialValue = "" ;
$ckeditor = new CKEditor( ) ;
$ckeditor->basePath  = 'ckeditor/' ;
CKFinder::SetupCKEditor( $ckeditor, 'ckfinder/' ) ;
$config['height'] = '300';
$config['toolbar'] = 'Full';
$ckeditor->editor('icerik', $initialValue, $config);
?>
		</label><br>
		<label>Dosya Ekle<br>
		<input type="file" name="dosya" />
		</label><br>
		<input type="submit" name="btn" value="Gönder" />
	</form>
	<?php
	if(isset($_POST["btn"]))
	{
		include 'class.phpmailer.php';
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->Username = 'umitdemirel.ozgenpls@gmail.com';
		$mail->Password = '19741974x';
		$mail->SetFrom($mail->Username, 'Ümit DEMİREL');
		$mail->AddAddress($_POST["eposta"], $_POST["adsoyad"]);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = 'Merhaba '.$_POST["adsoyad"];
		$content = '<div style="background: #eee; padding: 10px; font-size: 14px">
		<img src="https://www.google.com.tr/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png" alt="Google" /><hr>
		'.$_POST["icerik"].'
		</div>';
		/*if(isset($_FILES["dosya"]))
		{
			if($_FILES["dosya"]["name"]!="")
			{
				$mail->AddAttachment($_FILES["dosya"]["tmp_name"]);
			}
		}*/
		//$mail->AddAttachment($_FILES["dosya"]["tmp_name"]);
		$mail->MsgHTML($content);
		if($mail->Send()) {
			echo "Mesaj Gönderildi...";
		} else {
			// bir sorun var, sorunu ekrana bastıralım
			echo $mail->ErrorInfo;
		}
	}
	?>
	<!--
	Gmail üzerinde mail göndermek için aşağıdaki bağlantılardan izinleri ver.
https://www.google.com/settings/u/1/security/lesssecureapps
https://accounts.google.com/b/0/DisplayUnlockCaptcha
https://security.google.com/settings/security/activity?hl=en&pli=1
	-->
</body>
</html>