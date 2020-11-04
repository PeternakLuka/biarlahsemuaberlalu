<?php
    include_once("include/koneksi.php");
    $result = mysqli_query($conn, "SELECT * FROM tb_data ORDER BY konfirmasi DESC");
    if(isset($_POST['update']))
    {   
        for($a=1; $a<=count($_POST['kd_data']); $a++)
        {
            $kd_data = $_POST['kd_data'][$a];
            $konfirmasi=$_POST['konfirmasi'][$a];
            $sembuh=$_POST['sembuh'][$a];
            $suspek=$_POST['suspek'][$a];
            mysqli_query($conn, "UPDATE tb_data SET konfirmasi='$konfirmasi', sembuh='$sembuh', suspek='$suspek' WHERE kd_data=$kd_data");
        }
        header("Location: index.php");
    }
?>
<title>
    Update Data | Edit
</title>
<body>
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
                    echo "<td><input type='text' name='konfirmasi[]' value=".$data['konfirmasi']."></td>";
                    echo "<td><input type='text' name='sembuh[]' value=".$data['sembuh']."></td>";
                    echo "<td><input type='text' name='suspek[]' value=".$data['suspek']."></td>";
                    echo "</tr>";
                    echo "<input type='hidden' name='kd_data[]' value=".$data['kd_data'].">";
                }
            ?>
            <tr>
                <td colspan="2" align="center">
                    <button type="submit" name="update">Update Data</button>
                </td>
            </tr>
        </table>
    </form>
</body>