<title>
    Update Data | Edit
</title>
<body>
    <?php 
        include_once("include/koneksi.php");
        $result = mysqli_query($conn, "SELECT * FROM tb_data ORDER BY konfirmasi DESC");
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <td>Kota/Kabupaten</td>
                <td>Konfirmasi</td>
                <td>Sembuh</td>
                <td>Suspek</td>
            </tr>
            <?php  
                while($data = mysqli_fetch_array($result)) {   
                    echo "<tr>";
                    echo "<td><b>".$data['ktkb']."</b></td>";
                    echo "<td><input type='text' value=".$data['konfirmasi']."></td>";
                    echo "<td><input type='text' value=".$data['sembuh']."></td>";
                    echo "<td><input type='text' value=".$data['suspek']."></td>";
                    echo "</tr>";
                }
            ?>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Update Data"/></td>
                <td colspan="2" align="center"><input type="submit" value="Upload Gambar"/></td>
            </tr>
        </table>
    </form>
</body>