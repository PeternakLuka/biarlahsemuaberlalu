<!DOCTYPE html>
<html>
    <head>
        <style>
            .grid-container {
                display: grid;
                grid-template-columns: auto auto auto auto;
                grid-template-rows: 40px;
                grid-gap: 10px;
                background-color: #2196F3;
                padding: 10px;
            }

            .grid-container > div {
                /* background-color: rgba(255, 255, 255, 0.8); */
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
                /* text-align: center; */
                font-size: 20px;
            }

            .grid-container2 {
                display: grid;
                grid-template-columns: auto auto auto;
            }
        </style>
    </head>
    <body>
        <?php
            $no = 0;
            $kt = array();
            $kon = array();
            $sem = array();
            $sus = array();
            include_once("include/koneksi.php");
            $result = mysqli_query($conn, "SELECT * FROM tb_data ORDER BY konfirmasi DESC");
            $result_img = mysqli_query($conn, "SELECT imageId FROM tb_foto");
            
            $sum_p = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(konfirmasi) FROM tb_data"));
            $sum_s = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(sembuh) FROM tb_data"));
            $sum_m = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(suspek) FROM tb_data"));
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
        ?>
        <table width="100%">
            <tr>
                <td align="left" width="50%">   
                    <img src="img/LOGOKIRIBARU.png?>" width="60%"           height="60%" /><br/>
                </td>
                <td align="right" width="50%">
                    <img src="img/logokananbaru.png?>" width="60%" height="60%" /><br/>
                </td>
            </tr>
        </table>
        <br>
        <div class="grid-container">
            <div class="mantap1" style="background-image: url('img/LOGOKIRIBARU.png');"><?php echo $sum_p[0]; ?></div>
            <div class="mantap2"><?php echo $sum_s[0]; ?></div>
            <div class="mantap3"><?php echo $sum_m[0]; ?></div>  
            <div class="mantap4"><?php echo $total; ?></div>
        </div>
        <br/>
        <table width="100%">
            <tr align="center">
                <td colspan="2">DATA COVID-19 PROVINSI JATIM</td>
                <td>DATA COVID-19 KOTA MALANG</td>
            </tr>
            <tr>
                <td width="32%">
                    <table border="1" width="100%">
                        <tr>
                            <td>Kota/Kabupaten</td>
                            <td>Konfirmasi</td>
                            <td>Sembuh</td>
                            <td>Suspect</td>
                        </tr>
                        <?php  
                            $x = 0;
                            while($x < 20) {   
                                echo "<tr>";
                                echo "<td>".$kt[$x]."</td>";
                                echo "<td>".$kon[$x]."</td>";
                                echo "<td>".$sem[$x]."</td>";
                                echo "<td>".$sus[$x]."</td>";  
                                echo "</tr>";
                                $x++;
                            }
                        ?>
                    </table>
                </td>
                <td width="32%">
                    <table border="1" width="100%" >
                        <tr>
                            <td>Kota/Kabupaten</td>
                            <td>Konfirmasi</td>
                            <td>Sembuh</td>
                            <td>Suspect</td>
                        </tr>
                        <?php  
                            for($xy = 20; $xy < 40; $xy++) {   
                                echo "<tr>";
                                echo "<td>".$kt[$xy]."</td>";
                                echo "<td>".$kon[$xy]."</td>";
                                echo "<td>".$sem[$xy]."</td>";
                                echo "<td>".$sus[$xy]."</td>";  
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </td>
                <td width="36%" align="center">
                    <?php
                        while($row = mysqli_fetch_array($result_img)) {
                    ?>
                    <img src="imageView.php?image_id=<?php echo $row["imageId"]; ?>" width="100px" height="100px" /><br/>
                    <?php		
                        }
                        mysqli_close($conn);
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>