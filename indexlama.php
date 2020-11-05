<!DOCTYPE html>
<?php
    if(count($_FILES) > 0) {
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            require_once "include/koneksi.php";
            $imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
            $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
            
            $rslt = mysqli_query($conn, "SELECT imageId FROM tb_foto");
            while($data_img = mysqli_fetch_array($rslt)) {
                if(is_null($data_img['imageId'])){
                    $sql = "INSERT INTO tb_foto(imageType ,imageData)VALUES('{$imageProperties['mime']}', '{$imgData}')";
                }else{
                    $sql = "UPDATE tb_foto SET imageType='{$imageProperties['mime']}', imageData='{$imgData}' WHERE imageId=1";
                }
            }
            
            $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
            if(isset($current_id)) {
                header("Location: index.php");
            }
        }
    }
?>
<html>
    <head>
        <style>
            .grid-container {
                display: grid;
                grid-template-columns: auto auto auto auto;
                grid-template-rows: 50px;
                grid-gap: 10px;
                background-color: #2196F3;
                padding: 10px;
            }

            .grid-container > div {
                text-align: center;
                padding: auto 0;
                font-size: 30px;
            }

            .grid-container1 {
                display: grid;
                grid-template-columns: auto auto;
                grid-template-rows: 50px;
                padding-top: 10px;
            }

            .grid-container1 > div {
                background-color: rgba(255, 255, 255, 0.8);
                font-size: 20px;
            }

            .grid-container2 {
                display: grid;
                grid-template-columns: auto auto auto;
            }

            #popup {
                width: 100%;
                height: 100%;
                position: fixed;
                background: rgba(0,0,0,.7);
                top: 0;
                left: 0;
                z-index: 9999;
                visibility: hidden;
            }

            .window {
                width: 400px;
                height: 100px;
                background: #fff;
                border-radius: 10px;
                position: relative;
                padding: 10px;
                text-align: center;
                margin: 15% auto;
            }
            .window h2 {
                margin: 30px 0 0 0;
            }
            .close-button {
                width: 6%;
                height: 20%;
                line-height: 23px;
                background: #000;
                border-radius: 50%;
                border: 3px solid #fff;
                display: block;
                text-align: center;
                color: #fff;
                text-decoration: none;
                position: absolute;
                top: -10px;
                right: -10px;	
            }

            /* Memunculkan Jendela Pop Up*/
            #popup:target {
                visibility: visible;
            }

            .headknn { 
                margin: 3%; 
                position: relative; 
            } 
    
            .first-txt { 
                position: absolute; 
                top: 9%; 
                right: 15%; 
                color: #fff;
            } 

            .info { 
                margin: 3%;
                position: relative; 
            } 
    
            .info-txt1 { 
                position: absolute; 
                top: 6%; 
                left: 15%; 
                color: #fff;
            }
            .info-txt2 { 
                position: absolute; 
                top: 6%; 
                left: 15%; 
                color: #fff;
            } 
            .info-txt3 { 
                position: absolute; 
                top: 6%; 
                left: 15%; 
                color: #fff;
            } 
            .info-txt4 { 
                position: absolute; 
                top: 6%; 
                left: 22%; 
                color: #fff;
            } 
        </style>
    </head>
    <body style="margin: 0px">
        <div id="popup">
            <div class="window">
                <a href="#" class="close-button" title="Close">X</a>
                <form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
                    <label>Upload Gambar:</label><br/><br>
                    <input name="userImage" type="file" class="inputFile" /><br><br>
                    <input type="submit" value="Update" class="submit-button" />
                </form>
            </div>
        </div>
        <?php
            $no = 0;
            $no_ = 0;
            $smp = array();
            $kt = array();
            $kon = array();
            $sem = array();
            $sus = array();
            include_once("include/koneksi.php");
            $result_ = mysqli_query($conn, "SELECT * FROM tb_simpanan");
            $result = mysqli_query($conn, "SELECT * FROM tb_data ORDER BY konfirmasi DESC");
            $result_img = mysqli_query($conn, "SELECT imageId FROM tb_foto");
            
            $sum_p = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(konfirmasi) FROM tb_data"));
            $sum_s = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(sembuh) FROM tb_data"));
            $sum_mr1 = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(konfirmasi) FROM tb_data where kd_data = '2'"));
            $sum_mr2 = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(konfirmasi) FROM tb_data where kd_data = '25'"));
            $sum_mr3 = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(konfirmasi) FROM tb_data where kd_data = '14'"));
            $total = $sum_mr1[0] + $sum_mr2[0] + $sum_mr3[0];
            
            while($data = mysqli_fetch_array($result)) {
                $kt[$no] = $data['ktkb'];
                $kon[$no] = $data['konfirmasi'];
                $sem[$no] = $data['sembuh'];
                $sus[$no] = $data['suspek'];
                $no++;
            }

            while($data = mysqli_fetch_array($result_)) {
                $smp[$no_] = $data['isi'];
                $no_++;
            }
        ?>
        <table width="100%">
            <tr>
                <td align="left" width="50%">
                    <a href="updatedata.php">
                        <img src="img/LOGOKIRIBARU.png?>" width="60%" height="60%" />
                    </a>
                </td>
                <td align="right" width="50%">
                    <div class="headknn">
                        <a href="updatetgl.php">
                            <img src="img/headkanan.png" width="50%" height="60%"> 
                            <h3 class="first-txt"> 
                                <?php echo $smp[1]; ?>
                            </h3>
                        </a>
                    </div>
                </td>
            </tr>
        </table>
        <table style="margin-left: 7%">
            <tr>
                <td>
                    <div class="info"> 
                        <img src="img/positif.png" width="110%" height="115%"> 
                        <h2 class="info-txt1"> 
                            <?php echo $sum_p[0]; ?> 
                        </h2>
                    </div>
                </td>
                <td>
                    <div class="info"> 
                        <img src="img/sembuh.png" width="110%" height="115%"> 
                        <h2 class="info-txt2"> 
                            <?php echo $sum_s[0]; ?> 
                        </h2>
                    </div>
                </td>
                <td>
                    <div class="info"> 
                        <img src="img/meninggal.png" width="110%" height="115%"> 
                        <h2 class="info-txt3"> 
                            <?php echo $smp[0]; ?>
                        </h2>
                    </div>
                </td>
                <td>
                    <div class="info"> 
                        <img src="img/malangraya.png" width="110%" height="115%"> 
                        <h2 class="info-txt4"> 
                            <?php echo $total; ?> 
                        </h2>
                    </div>
                </td>
            </tr>
        </table>
        <table style="border-collapse: collapse;" width="100%">
            <tr align="center">
                <td colspan="2"><a style="font-size:2vw; font-family:calibri"><strong>DATA COVID-19 PROVINSI JATIM</strong></a></td>
                <td><a style="font-size:2vw; font-family:calibri"><strong>DATA COVID-19 KOTA MALANG</strong></a></td>
            </tr>
            <tr>
                <td width="27%">
                    <table style="border-collapse: collapse;" width="100%">
                        <tr>
                            <th style="font-size: 1.2vw; background-color:#3c1d47; color:#fff; padding-top:8px; padding-bottom:8px; text-align:center">Kota/Kabupaten</th>
                            <th style="font-size: 1.2vw; background-color:#ed183d; color:#fff; text-align:center">Konfirm</th>
                            <th style="font-size: 1.2vw; background-color:#00a550; color:#fff; text-align:center">Sembuh</th>
                            <th style="font-size: 1.2vw; background-color:#f5811e; color:#fff; text-align:center">Suspect</th>
                        </tr>
                        <?php  
                            $x = 0;
                            while($x < 20) {   
                                echo "<tr>";
                                echo "<td style='padding-top:2px; padding-bottom:2px; font-size: 1.05vw;'><b>".$kt[$x]."</b></td>";
                                echo "<td style='font-size: 1.05vw; text-align:center'><b>".$kon[$x]."</b></td>";
                                echo "<td style='font-size: 1.05vw; text-align:center'><b>".$sem[$x]."</b></td>";
                                echo "<td style='font-size: 1.05vw; text-align:center'><b>".$sus[$x]."</b></td>";  
                                echo "</tr>";
                                $x++;
                            }
                        ?>
                    </table>
                </td>
                <td width="27%">
                    <table style="border-collapse: collapse;" width="100%" >
                        <tr>
                            <th style="font-size: 1.2vw; background-color:#3c1d47; color:#fff; padding-top:8px; padding-bottom:8px; text-align:center">Kota/Kabupaten</th>
                            <th style="font-size: 1.2vw; background-color:#ed183d; color:#fff; text-align:center">Konfirm</th>
                            <th style="font-size: 1.2vw; background-color:#00a550; color:#fff; text-align:center">Sembuh</th>
                            <th style="font-size: 1.2vw; background-color:#f5811e; color:#fff; text-align:center">Suspect</th>
                        </tr>
                        <?php  
                            for($xy = 20; $xy < 40; $xy++) {   
                                echo "<tr>";
                                echo "<td style='padding-top:2px; padding-bottom:2px; font-size: 1.05vw;'><b>".$kt[$xy]."</b></td>";
                                echo "<td style='font-size: 1.05vw; text-align:center'><b>".$kon[$xy]."</b></td>";
                                echo "<td style='font-size: 1.05vw; text-align:center'><b>".$sem[$xy]."</b></td>";
                                echo "<td style='font-size: 1.05vw; text-align:center'><b>".$sus[$xy]."</b></td>";  
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </td>
                <td width="40%" align="center">
                    <?php
                        while($row = mysqli_fetch_array($result_img)) {
                    ?>
                    <a href="#popup">
                        <img src="imageView.php?image_id=<?php echo $row["imageId"]; ?>" width="100%" height="49%" />
                    </a><br/>
                    <?php		
                        }
                        mysqli_close($conn);
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>