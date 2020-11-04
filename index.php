<!DOCTYPE html>
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
                background-color: rgba(255, 255, 255, 0.8);
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
            include_once("include/koneksi.php");
            $result = mysqli_query($conn, "SELECT * FROM tb_data ORDER BY konfirmasi ASC LIMIT 20");
            $result2 = mysqli_query($conn, "SELECT * FROM tb_data ORDER BY konfirmasi ASC LIMIT 21,20");
            $result_img = mysqli_query($conn, "SELECT imageId FROM tb_foto");
        ?>
        <table width="100%">
            <tr>
                <td align="left">Header Kiri</td>
                <td align="right">Header Kanan</td>
            </tr>
        </table>
        <div class="grid-container">
            <div class="mantap1">Positif</div>
            <div class="mantap2">Sembuh</div>
            <div class="mantap3">Meninggal</div>  
            <div class="mantap4">Malang Raya</div>
        </div>
        <div class="grid-container1">
            <div class="461" style="text-align: center">DATA COVID-19 PROVINSI JATIM</div>
            <div class="462" style="text-align: right">DATA COVID-19 KOTA MALANG</div>
        </div>
        <div class="grid-container2">
            <?php $d = 0 ?>
            <div class="patnam1">
                <table border="1" width="90%">
                    <tr>
                        <td>Kota/Kabupaten</td>
                        <td>Konfirmasi</td>
                        <td>Sembuh</td>
                        <td>Suspect</td>
                    </tr>
                    <?php  
                        while($data = mysqli_fetch_array($result)) {   
                            echo "<tr>";
                            echo "<td>".$data['ktkb']."</td>";
                            echo "<td>".$data['konfirmasi']."</td>";
                            echo "<td>".$data['sembuh']."</td>";
                            echo "<td>".$data['suspek']."</td>";  
                            echo "</tr>"; 
                            $d++;
                        }
                    ?>
                </table>
            </div>
            <div class="patnam2">
                <table border="1" width="90%" >
                    <tr>
                        <td>Kota/Kabupaten</td>
                        <td>Konfirmasi</td>
                        <td>Sembuh</td>
                        <td>Suspect</td>
                    </tr>
                    <?php  
                        while($data = mysqli_fetch_array($result2)) {   
                            echo "<tr>";
                            echo "<td>".$data['ktkb']."</td>";
                            echo "<td>".$data['konfirmasi']."</td>";
                            echo "<td>".$data['sembuh']."</td>";
                            echo "<td>".$data['suspek']."</td>";  
                            echo "</tr>"; 
                            $d++;
                        }
                    ?>
                </table>
            </div>
            <div class="patnam3">
                <?php
                    while($row = mysqli_fetch_array($result_img)) {
                    ?>
                        <img src="imageView.php?image_id=<?php echo $row["imageId"]; ?>" width="100px" height="100px" /><br/>
                    
                <?php		
                    }
                    mysqli_close($conn);
                ?>
            </div>  
            <!-- <div class="patnam4">Foto Col 2<br/>Row 1 & 2</div> -->
        </div>
    </body>
</html>