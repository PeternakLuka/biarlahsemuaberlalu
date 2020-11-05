<?php
    include_once("../include/koneksi.php");
    $result = mysqli_query($conn, "SELECT * FROM tb_simpanan");
    if(isset($_POST['update']))
    {   
        for($a=1; $a<=count($_POST['kd_data']); $a++)
        {
            $kd_data = $_POST['kd_data'][$a];
            $konfirmasi=$_POST['isi'][$a];
            mysqli_query($conn, "UPDATE tb_simpanan SET isi='$konfirmasi' WHERE kd_simpanan=$kd_data");
        }
        header("Location: ../index.php");
    }
?>
<title>
    Update Data | Edit
</title>
<body>
    <form action="" method="post">
        <table>
            <?php  
                while($data = mysqli_fetch_array($result)) {   
                    if($data['kd_simpanan']==1){
                        echo "<tr>";
                        echo "<td>Total Meninggal</td>";
                        echo "</tr>";
                    }else{
                        echo "<tr>";
                        echo "<td>Tanggal Update</td>";
                        echo "</tr>";
                    }
                    echo "<tr>"; ?>
                    <!-- echo "<td><input type='text' name='isi[]' value=".$data['isi']."></td>"; -->
                    <td><input type="text" name="isi[]" value="<?php echo $data['isi'] ?>"></td>
            <?php
                    echo "</tr>";
                    echo "<input type='hidden' name='kd_data[]' value=".$data['kd_simpanan'].">";
                }
            ?>
            <tr>
                <td colspan="2" align="center">
                    <br/>
                    <button type="submit" name="update">Update Data</button>
                </td>
            </tr>
        </table>
    </form>
</body>