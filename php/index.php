<?php 


$servername = "localhost";
$username = "root";
$password = "espn1997";
$dbname = "arac_kirala";

	$baglanti = new mysqli ($servername,$username,$password,$dbname);

	if($baglanti->connect_error) {
		echo "Bağlantı oluşmadı".$baglanti->connect_error;
		
	}else{
		
}

?>

<!-- MUSTERİ KAYITLARINI ÇEKME -->
<?php

	$bul = "SELECT * FROM musteriler ORDER BY id DESC";

	$kayit = $baglanti->query($bul);

?>

<!-- ARABALARI ÇEKME -->
<?php

	$bul_araba = "SELECT * FROM arabalar ORDER BY arac_vin DESC";

	$kayit_araba = $baglanti->query($bul_araba);


?>

<!-- MUSTERİ KAYDETME -->
<?php 

	if(isset($_POST["kaydet"]))
	{
		$sql = "INSERT INTO musteriler(adi,soyadi,tc_no,e_mail,tel_no,kiralanan_model)values('".$_POST["user_name"]."','".$_POST["last_name"]."','".$_POST["identitiy_no"]."','".$_POST["e_mail"]."','".$_POST["phone_no"]."','".$_POST["marka_model"]."')";
		
		$sonuc = mysqli_query($baglanti,$sql);
		if($sonuc)
		{
			echo " veri eklendi";
			header("Location:index.php");
		}else{
			echo " veri eklenmedi!!";
			header("Location:index.php");
		}
		
	}
?>

<!-- MUSTERİ SİLME -->

<?php
	if(isset($_GET["sil"])){
		$gelenid = $_GET["sil"];
		$sql_delete = "DELETE FROM `musteriler` WHERE `musteriler`.`id` = ".$gelenid;
		mysqli_query($baglanti,$sql_delete);
		echo "basıldı".$gelenid;
		header("Location:index.php");
	}
	if(isset($_GET["guncelle2"])){
		echo "basıldı gg";
	}

?>


<!doctype html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	  
	  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

    <title>Hello, world!</title>
  </head>
  <body>
    

    
<div class="container-fluid mt-3" style="background-color: #f0f0f0;">
  <div class="col-md-12 justify-content-center">
	  
  <!-- MUSTERİ KAYIT KISMI -->
  <div class="row-md-12 d-flex justify-content-center p-3 m-2" id="musteri_kayit">
	  
	  	<form method="post">
		  <div class="form-row">
			<div class="col">
			  <label for="UserName">Adı</label>
			  <input type="text" class="form-control" placeholder="UserName" id="UserName" name="user_name">
			</div>
			  
			<div class="col">
			  <label for="LastName">Soyadı</label>
			  <input type="text" class="form-control" placeholder="LastName" id="LastName" name="last_name">
			</div>
			  
			<div class="col">
			  <label for="IdentityNo">Tc No</label>
			  <input type="text" class="form-control" placeholder="IdentityNo" id="IdentityNo" name="identitiy_no">
			</div>
			  
			<div class="col">
			  <label for="Email">E-Mail</label>
			  <input type="text" class="form-control" placeholder="Email" id="Email" name="e_mail">
			</div>
			  
			<div class="col">
			  <label for="PhoneNo">Telefon No</label>
			  <input type="text" class="form-control" placeholder="PhoneNo" id="PhoneNo" name="phone_no">
			</div>
			  
		  </div>
			
		  
		  <div class="form-row mt-2">
			<div class="col">
				<label for="exampleFormControlSelect1">Kiralanan Model</label>
				<select class="form-control" id="exampleFormControlSelect1" name="marka_model">
				  <?php while($sonucaraba=mysqli_fetch_assoc($kayit_araba)) { ?>
					  <option><?php echo $sonucaraba['arac_adi']."  ".$sonucaraba['model_adi']; ?></option>
				  <?php } ?>
				</select>
		  </div>
			 <div class="col mt-4">
				 <button type="submit" name="kaydet" class="btn btn-success float-right">Kaydet</button>
			 </div>
		</div>
		</form>
  </div>
	  
	
	  
	  <!-- MUSTERİLER TABLO KISMI -->
	  <div class="row-md-12 d-flex justify-content-center p-3 m-2">
		  
		  <form method="get" action="">
		  <table class="table">
			  <thead class="thead-dark">
				<tr>
				  <th scope="col">id</th>
				  <th scope="col">Müşteri Adı</th>
				  <th scope="col">Müşteri Soyadı</th>
				  <th scope="col">Müşteri Tc No</th>
				  <th scope="col">Müşteri E-Mail</th>
				  <th scope="col">Müşteri Tel No</th>
				  <th scope="col">Kiralanan Araç</th>
				  <th scope="col">Kiralama Tarihi</th>
					<th scope="col">işlem</th>
				</tr>
			  </thead>
			  <tbody>
				<?php while($sonuc=mysqli_fetch_assoc($kayit)) { ?>
				<tr>
				  <th scope="row"><?php echo $sonuc["id"]; ?></th>
				  <td><?php echo $sonuc["adi"]; ?></td>
				  <td><?php echo $sonuc["soyadi"]; ?></td>
				  <td><?php echo $sonuc["tc_no"]; ?></td>
				  <td><?php echo $sonuc["e_mail"]; ?></td>
				  <td><?php echo $sonuc["tel_no"]; ?></td>
				  <td><?php echo $sonuc["kiralanan_model"];?></td>
				  <td><?php echo $sonuc["tarih"]; ?></td>
					
				  <td><a href="?sil=<?=$sonuc['id']?>" type="submit" class="btn btn-outline-danger" name="sil">Sil</a>
					  
				  <a href="guncelle_page.php?id=<?=$sonuc['id']?>" type="button" id="guncelle" class="btn btn-outline-dark">Güncelle</a></td>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
		</form>
	  </div>
	  <?php while($sonucaraba=mysqli_fetch_assoc($kayit_araba)) { ?>
	  	<h5>Araba Marka: <?php echo $sonucaraba['arac_adi']; ?></h5>
	  	
	  <?php } ?>

	<a href="arac_ekle_page.php" style="text-decoration: none;"><button type="button" class="btn btn-block btn-success mt-2">Araba Ekle</button></a>
  </div>
</div>
	  
	  

	  
	  


	  
	  
	  
	  
	  
	  
	  
	  
	  
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>