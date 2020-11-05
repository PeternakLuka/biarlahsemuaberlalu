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
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body style="width: 50%; margin: auto; padding: 10px">
    <div class="w3-card-4">
        <div class="w3-container w3-brown">
            <h2>Update Total Meninggal & Tanggal</h2>
        </div>
        <form class="w3-container" action="" method="post">
            <?php  
                while($data = mysqli_fetch_array($result)) {   
                    if($data['kd_simpanan']==1){
                        echo "<p>";
                        echo "<label class='w3-text-brown'><b>Total Meninggal</b></label>";
                        // echo "</p>";
                    }else{
                        echo "<p>";
                        echo "<label class='w3-text-brown'><b>Tanggal Update</b></label>";
                    }
            ?>
                <input class="w3-input w3-border w3-sand" type="text" name="isi[]" value="<?php echo $data['isi'] ?>">
            <?php
                    echo "</p>";
                    echo "<input type='hidden' name='kd_data[]' value=".$data['kd_simpanan'].">";
                }
            ?>
            <center>
                <button class="w3-btn w3-brown" type="submit" name="update">Update Data</button>
            </center>
        </form>
    </div>
</body>