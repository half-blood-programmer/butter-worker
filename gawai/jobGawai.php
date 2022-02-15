
<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  if (isset($_GET['id'])) 
  {
    extract($n->dapatId($_GET['id']));  
  
    extract($n->dapatAkun($_GET['id']));

    extract($n->dapatNewjob($_GET['id']));
  }
  
  if(isset($_POST['downloadJob']))
  {
    $id_job = $_POST['id_job'];

    $n->downloadJob($id_job);
  }

  if(isset($_POST['cariJobA']))
  {
    $nama_job = $_POST['nama_job'];
        
    $n->cariJobG($nama_job);   
  }
  if(isset($_POST['cariJobB']))
  {
    $idJob = $_POST['idJob'];
    
    $n->cariJobGB($idJob);   
  }  
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/tam.css">
  <link rel="shortcut icon" type="imaage/x-icon" href="../gal/logoKotak.png"/>
  <title>AdWorker|A d' Real Worker</title>
</head> 
<body>
  <div class="header">
  </div>
  <div class="topnav" >
    <a class="dashboard" style="float:left">Job</a>
    <div class="dropdown">
      <div class="containerM" onclick="myFunctionX(this)">
        <div onclick="myFunctionMenu()" class="dropbtn">
          <div class="bar1" onclick="myFunctionMenu()"></div>
          <div class="bar2" onclick="myFunctionMenu()"></div>
          <div class="bar3" onclick="myFunctionMenu()"></div>
        </div>
      </div>
    </div>
  </div>
  
    <div id="myDropdown" class="dropdown-content">
      <a href="gawai.php?id=<?=$nip?>" >Dashboard</a><br>
      <a href="../visitor/visitor.php" >Visitors Page</a><br>
      <a href="#.php" >News</a><br>
      <a href="#.php" >Pengumuman</a><br>
      <a href="../visitor/gal.php" >Gallery</a><br>
      <a href="../hom.php">Exit</a>
    </div>

  </div>
  <div class="row">
    <div class="leftcolumn">
      <div class="card">
        <a><h2>Your New Job</h2></a>
        <hr>

        <?php
          if ($ket == "selesai") 
          {
        ?>
        
            <input type="submit" class="forembtn" value="No Newest Job Yet" style="margin-left:260px;">
            <br><br>
            <hr>

        <?php    
          }
          else
          {  
        ?>  

        <form class="forem" method="post" action="" style="padding-left:10%">
          <div class="leftforem">
            <label>ID JOB</label>
              <input type="text" value="<?=$id_job?>" name="id_job" readonly="readonly">
            <label>Judul Job</label>
              <input type="text" value="<?=$nama_job?>" name="nama_job" readonly="readonly">
          </div>
          <div class="rightforem">
            <label>Tanggal Diberikan</label><label style="margin-left:46px">Deadline</label>
              <input type="date" value="<?=$tgl_diberikan?>" class="date" style="width:49%" readonly="readonly">
              <input type="date" value="<?=$deadline?>" class="date" style="width:49%" readonly="readonly">
              <br><br>
            <label>Detail Job</label><label style="margin-left:44px">Keterangan</label>
              <br>
              <input type="submit" name="downloadJob" class="forembtn" value="Download" 
               style="height:51px;font-size:16px;width:30%">
              <input type="text" value="<?=$ket?>" readonly="readonly" style="width:68%">
          </div>
          <input type="reset" style="width:0px;height:0px">
          <a href="laporan.php?id=<?=$nip?>&job=<?=$id_job?>"> KIRIM LAPORAN</a> 
        </form>
        <hr>

        <?php
          }
        ?>
      </div>
    <div class="card">
        <a><h2>Late's Job</h2></a>
        <div class="row">
          <div class="gallery">

          <?php


            $no = 1;
            $query = "SELECT id_job,nip,nama_job,deadline FROM job WHERE ket='selesai' AND  nip='$nip' ORDER BY id_job DESC LIMIT 3";            
            $stmt = $n->kon->query($query);
          
            while ($data = $stmt->fetch_array())
            {
              echo
              "
              <div class=\"column\" id=$no style=\"width:225px;height:200px;\">
                <table border=\"0\" class=\"tableLap\">
                  <tr>
                    <th colspan=\"2\">$data[nama_job]</th>
                  </tr>
                  <tr>
                    <td style=\"width:30%\">Id Job</td>
                    <td style=\"width:70%\" >$data[id_job]</td>
                  </tr>
                  <tr>
                    <td style=\"width:30%\">NIP</td>
                    <td style=\"width:70%\" >$data[nip]</td>
                  </tr>
                  <tr>
                    <th colspan=\"2\">$data[deadline]</th>
                  </tr>  
                  <tr>      
                    <td colspan=\"2\">
                      <a href=\"tampilJob.php?id=$data[nip]&job=$data[id_job]\">++ See</a>
                    </td>
                  </tr>
                </table>              
              </div>
              ";
              $no++;
            }

              echo 
              "
              <div class=\"column\" id=$no style=\"width:119px;height:200px;\">
                <a href=\"bio.php?id=$nip\" style=\"color:#10b3ffb3;text-align:center;margin-top:68px\">
                <h2>More</h2></a>   
              </div>
              ";
          ?> 

          </div> 
        </div>
      </div>
    </div>
    <div class="rightcolumn">
      <div class="card"> 
        <a><h2 style="font-size:36px;">Mesin Pencari</h2></a>
        <form method="post" action="" class="forem" style="padding-left:2px;width:auto;">
          <label>Judul job</label>
            <input type="text" name="nama_job" placeholder="Cari Judul Job" required>
          <input type="submit" name="cariJobA" value="CARI" class="forembtn" style="width:100%;height:50px">
        </form>
        <hr>
        <form method="post" action="" class="forem" style="padding-left:2px;width:auto;">
          <label>ID JOB</label>
            <input type="text" name="id_job" placeholder="Cari ID JOB" required>
          <input type="submit" name="cariJobB" value="CARI" class="forembtn" style="width:100%;height:50px">
        </form>
        <hr>
      </div>  
    </div>  
  </div>
  <div class="row">
    <div class="columnA">
      <div class="cardB">
        <a href="bio.php?id=<?=$nip?>">
          <img src="../gal/tampilData.png" class="avatar" style="width:120px;height:120px;float:left;">
          <h5> Biodata </h5><br>
          <b>Menampilkan Data Anda</b><br>
          AdWorker <br>
          A d' Real Worker <br>
        </a>
      </div>
    </div>
    <div class="columnB">
      <div class="cardB">
        <a href="gajiGawai.php?id=<?=$nip?>">
          <img src="../gal/gaji.png" class="avatar" style="width:120px;height:120px;float:left;">
          <h5> Gaji</h5><br>
          <b>Melihat Rincian Gaji</b><br>
          AdWorker <br>
          A d' Real Worker <br>
        </a>
      </div>
    </div>
    <div class="columnC">
      <div class="cardB">
        <a href="jobGawai.php?id=<?=$nip?>">
          <img src="../gal/edit.png" class="avatar" style="width:120px;height:120px;float:left;">
          <h5> Job</h5><br>
          <b>Tentang Pekerjaan Anda</b><br>
          AdWorker <br>
          A d' Real Worker <br>
        </a>
      </div>
    </div>
  </div>
  <div class="footer">
    Adam Junio Selva &copy
  </div>

<script>
  //menu animasi
  function myFunctionX(x) 
  {
    x.classList.toggle("change");
  }
  //Dropdown
  function myFunctionMenu() 
  {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  window.onclick = function(event) 
  {
    
    if (!event.target.matches('.dropbtn')) 
    {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
  
      for (i = 0; i < dropdowns.length; i++) 
      {
        var openDropdown = dropdowns[i];
        
        if (openDropdown.classList.contains('show')) 
        {
          openDropdown.classList.remove('show');
        }
      }
    }
  }

</script>

</body>
</html>  