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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @font-face {
                font-family: EB;
                src: url(font/EB.otf);
            }
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

            #popup:target {
                visibility: visible;
            }

            .headknn { 
                margin: 3%; 
                position: relative; 
            } 
    
            .first-txt { 
                position: absolute; 
                top: 14%; 
                right: 9%; 
                color: #fff;
            } 

            .info { 
                margin: 3%;
                position: relative; 
            } 
    
            .info-txt1 { 
                position: absolute; 
                top: 11%; 
                left: 16%; 
                color: #fff;
            }
            .info-txt2 { 
                position: absolute; 
                top: 11%; 
                left: 17%; 
                color: #fff;
            } 
            .info-txt3 { 
                position: absolute; 
                top: 11%; 
                left: 17%; 
                color: #fff;
            } 
            .info-txt4 { 
                position: absolute; 
                top: 11%; 
                left: 20%; 
                color: #fff;
            } 
        </style>
    </head>
    <body style="margin: 0px; background-image: url('img/bg.png');" >
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
            $kt = array();
            $kon = array();
            $sem = array();
            $sus = array();
            $kot = array();
            include_once("include/koneksi.php");
            $result = mysqli_query($conn, "SELECT * FROM tb_data ORDER BY konfirmasi DESC");
            $result_img = mysqli_query($conn, "SELECT imageId FROM tb_foto");

            $sum_men = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(meninggal) FROM tb_data"));
            $sum_p = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(konfirmasi) FROM tb_data"));
            $sum_s = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(sembuh) FROM tb_data"));
            $sum_mr1 = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(konfirmasi) FROM tb_data where ktkb = 'KAB. MALANG'"));
            $sum_mr2 = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(konfirmasi) FROM tb_data where ktkb = 'KOTA MALANG'"));
            $sum_mr3 = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(konfirmasi) FROM tb_data where ktkb = 'KOTA BATU'"));
            $total = $sum_mr1[0] + $sum_mr2[0] + $sum_mr3[0];
            
            while($data = mysqli_fetch_array($result)) {
                $kt[$no] = $data['ktkb'];
                $kon[$no] = $data['konfirmasi'];
                $sem[$no] = $data['sembuh'];
                $sus[$no] = $data['suspek'];
                $no++;
            }
        ?>
        <table width="100%">
            <tr>
                <td align="left" width="50%">
                    <a href="data/updatedata.php">
                        <img src="img/LOGOKIRIBARU.png?>" width="70%" height="%" min-width="50%" max-width="100%" />
                    </a>
                </td>
                <td align="right" width="50%">
                    <div class="headknn">
                        <img src="img/headkanan.png" width="60%" height="70%"> 
                        <h1 class="first-txt" style="font-family:EB"> 
                            <?php echo date("d F Y", mktime(0, 0, 0, date("m"), date("d")-1, date("Y"))); ?>
                        </h1>
                    </div>
                </td>
            </tr>
        </table>
        <br/><br/>
        <center>
        <table>
            <tr>
                <td>
                    <div class="info"> 
                        <img src="img/positif.png" width="120%" height="125%"> 
                        <h2 class="info-txt1"> 
                            <?php echo $sum_p[0]; ?> 
                        </h2>
                    </div>
                </td>
                <td style="padding-left: 70px;">
                    <div class="info"> 
                        <img src="img/sembuh.png" width="120%" height="125%"> 
                        <h2 class="info-txt2"> 
                            <?php echo $sum_s[0]; ?> 
                        </h2>
                    </div>
                </td>
                <td style="padding-left: 70px;">
                    <div class="info"> 
                        <img src="img/meninggal.png" width="120%" height="125%"> 
                        <h2 class="info-txt3"> 
                            <?php echo $sum_men[0]; ?>
                        </h2>
                    </div>
                </td>
                <td style="padding-left: 70px;">
                    <div class="info"> 
                        <img src="img/malangraya.png" width="120%" height="125%"> 
                        <h2 class="info-txt4"> 
                            <?php echo $total; ?> 
                        </h2>
                    </div>
                </td>
            </tr>
        </table>
        </center>
        <br/>
        <table style="border-collapse: collapse;" width="100%">
            <tr align="center">
                <td colspan="2"><a style="font-size:2vw; font-family:EB"><i>DATA COVID-19 PROVINSI JATIM</i></a></td>
                <td><a style="font-size:2vw; font-family:EB"><i>DATA COVID-19 KOTA MALANG</i></a></td>
            </tr>
            <tr>
                <td width="27%">
                    <table style="border-collapse: collapse;" width="100%">
                        <tr>
                            <th style="font-size: 0.94vw; font-family:arial; padding-left:5px; padding-right:5px; background-color:#3c1d47; color:#fff; padding-top:15px; padding-bottom:15px; text-align:center"><i>KOTA/KABUPATEN</i></th>
                            <th style="font-size: 0.94vw; font-family:arial; padding-left:5px; padding-right:5px; background-color:#D21404; color:#fff; text-align:center"><i>KONFIRM</i></th>
                            <th style="font-size: 0.94vw; font-family:arial; padding-left:5px; padding-right:5px; background-color:#028A0F; color:#fff; text-align:center"><i>SEMBUH</i></th>
                            <th style="font-size: 0.94vw; font-family:arial; padding-left:5px; padding-right:5px; background-color:#FF6700; color:#fff; text-align:center"><i>SUSPECT</i></th>
                        </tr>
                        <?php  
                            $x = 0;
                            while($x < 20) {   
                                if ($kt[$x] == "KOTA SURABAYA" || $kt[$x] == "KAB. MALANG" || $kt[$x] == "KOTA MALANG" || $kt[$x] == "KOTA BATU"){
                                    echo "<tr>";
                                    echo "<td style='padding-top:3px; font-family:arial; padding-bottom:3px; font-size: 0.94vw; background-color:#53207c; color:#fff;'><b><i>".$kt[$x]."</i></b></td>";
                                    echo "<td style='font-size: 1.05vw; font-family:arial; text-align:center; background-color:#e12423; color:#fff'><b><i>".$kon[$x]."</i></b></td>";
                                    echo "<td style='font-size: 1.05vw; font-family:arial; text-align:center; background-color:#06ac0c; color:#fff'><b><i>".$sem[$x]."</i></b></td>";
                                    echo "<td style='font-size: 1.05vw; font-family:arial; text-align:center; background-color:#FC8A17; color:#fff'><b><i>".$sus[$x]."</i></b></td>";  
                                    echo "</tr>";                                    
                                }
                                else {
                                    echo "<tr>";
                                    echo "<td style='padding-top:3px; font-family:arial; padding-bottom:3px; font-size: 0.94vw;'><b><i>".$kt[$x]."</i></b></td>";
                                    echo "<td style='font-size: 1.05vw; font-family:arial; text-align:center'><b><i>".$kon[$x]."</i></b></td>";
                                    echo "<td style='font-size: 1.05vw; font-family:arial; text-align:center'><b><i>".$sem[$x]."</i></b></td>";
                                    echo "<td style='font-size: 1.05vw; font-family:arial; text-align:center'><b><i>".$sus[$x]."</i></b></td>";  
                                    echo "</tr>";
                                }
                                $x++;
                            }
                        ?>
                    </table>
                </td>
                <td width="27%">
                    <table style="border-collapse: collapse;" width="100%" >
                        <tr>
                        <th style="font-size: 0.94vw; font-family:arial; padding-left:5px; padding-right:5px; background-color:#3c1d47; color:#fff; padding-top:15px; padding-bottom:15px; text-align:center"><i>KOTA/KABUPATEN</i></th>
                            <th style="font-size: 0.94vw; font-family:arial; padding-left:5px; padding-right:5px; background-color:#D21404; color:#fff; text-align:center"><i>KONFIRM</i></th>
                            <th style="font-size: 0.94vw; font-family:arial; padding-left:5px; padding-right:5px; background-color:#028A0F; color:#fff; text-align:center"><i>SEMBUH</i></th>
                            <th style="font-size: 0.94vw; font-family:arial; padding-left:5px; padding-right:5px; background-color:#FF6700; color:#fff; text-align:center"><i>SUSPECT</i></th>
                        <?php

                            for($xy = 20; $xy < 40; $xy++) {
                                if ($kt[$xy] == "KOTA SURABAYA" || $kt[$xy] == "KAB. MALANG" || $kt[$xy] == "KOTA MALANG" || $kt[$xy] == "KOTA BATU"){
                                    echo "<tr>";
                                echo "<td style='padding-top:3px; font-family:arial; padding-bottom:3px; font-size: 0.94vw; background-color:#53207c; color:#fff;'><b><i>".$kt[$xy]."</i></b></td>";
                                echo "<td style='font-size: 1.0vw; font-family:arial; text-align:center; background-color:#e12423; color:#fff'><b><i>".$kon[$xy]."</i></b></td>";
                                echo "<td style='font-size: 1.0vw; font-family:arial; text-align:center; background-color:#06ac0c; color:#fff'><b><i>".$sem[$xy]."</i></b></td>";
                                echo "<td style='font-size: 1.0vw; font-family:arial; text-align:center; background-color:#FC8A17; color:#fff'><b><i>".$sus[$xy]."</i></b></td>";  
                                echo "</tr>";
                                }
                                else{
                                    echo "<tr>";
                                echo "<td style='padding-top:3px; font-family:arial; padding-bottom:3px; font-size: 0.94vw;'><b><i>".$kt[$xy]."</i></b></td>";
                                echo "<td style='font-size: 1.0vw; font-family:arial; text-align:center'><b><i>".$kon[$xy]."</i></b></td>";
                                echo "<td style='font-size: 1.0vw; font-family:arial; text-align:center'><b><i>".$sem[$xy]."</i></b></td>";
                                echo "<td style='font-size: 1.0vw; font-family:arial; text-align:center'><b><i>".$sus[$xy]."</i></b></td>";  
                                echo "</tr>";
                                }
                            }
                        ?>
                    </table>
                </td>
                <td width="40%" align="center">
                    <?php
                        while($row = mysqli_fetch_array($result_img)) {
                    ?>
                    <a href="#popup">
                        <img src="include/imageView.php?image_id=<?php echo $row["imageId"]; ?>" width="100%" height="%" min-width="10%" max-width="100%"/>
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