<?php
function curl_gir($site) {
$ch = curl_init($site);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_REFERER, $site);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_NOBODY, 0);
$index = curl_exec($ch);
return $index;
}
?><html>
	<head>
	<title>wordpress yorum yapıcı - v4r1able</title>
	</head>
	<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Ruda&display=swap');
	
	body {
	padding: 50px;
	background-image: url("https://v4.obir.ninja/bg.jpg");
	}
	
	h3 {
	font-size:25px;
	font-family:Ruda;
	color:#2196f3;
	}
	
	h1 {
	font-family:Ruda;
	color:white;
	}
	
	input {
	text-align:center;
	}
	
	textarea {
	text-align:center;
	}
	</style>
	<body>
<center>
	<h1>v4r1able - obir.ninja</h1>
<form action="" method="POST">
<input type="text" name="author" placeholder="

Gönderen"><br><br>
<input type="text" name="email" placeholder="

E-Mail"><br><br>
<input type="text" name="url" placeholder="

https://site.com"><br><br>
<textarea type="text" name="yorum" placeholder="
yorumunuzu giriniz" style="width: 760px; height: 183px;"></textarea><br><br>
<textarea type="text" name="siteler" placeholder="
site adresleri alt alta" style="width: 760px; height: 183px;"></textarea><br><br>
<button type="submit" name="yorum_gonder">Yorumu Gönder</button>
</form>
<?php
if(isset($_POST["yorum_gonder"])) {
	if(empty($_POST["author"] and $_POST["email"] and $_POST["url"] and $_POST["siteler"] and $_POST["yorum"])) {
		echo '<h3>boş alan bırakmayınız.</h3>';
		exit;
	}
function ana_adres($adres) {
$adres_bol = explode("/", $adres);
$www_sil = str_replace("www.", "", $adres_bol[2]);
return $www_sil;
}

function ana_adres_2($adres) {
$adres_bol = explode("/", $adres);
$www_sil = str_replace("www.", "", $adres_bol[3]);
return $www_sil;
}
$yorum = $_POST["yorum"];
$gir = file_get_contents($_POST["siteler"]);
preg_match_all("@<input type='hidden' name='comment_post_ID' value='(.*?)'@si",$gir,$post_id);
$post_id_real = $post_id[1][0];
$ana_adres = ana_adres($_POST["siteler"]);
$yeni_adres = ("https://".$ana_adres."/wp-comments-post.php");
$curl_gir = curl_gir($yeni_adres);
if(strstr($curl_gir, "404")) {
echo '<h3>'.$yeni_adres.' bu adrese ulaşılamıyor(404)</h3>';
exit;
}
$ch = curl_init($yeni_adres);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36");
curl_setopt($ch, CURLOPT_REFERER, $_POST["siteler"]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "comment=".$yorum."&author=".$_POST["author"]."&email=".$_POST["email"]."&url=".$_POST["url"]."&comment_post_ID=".$post_id_real."&comment_parent=0");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_NOBODY, 0);
$index = curl_exec($ch);
echo '<h3>Gönderilmiş olması gerekiyor! kontrol ediniz : <a rel="nofollow" href="'.htmlspecialchars($_POST["siteler"]).'" target="_blank">Gönderiye git</a></h3>';
}
?>
</center>
</body>
</html>
