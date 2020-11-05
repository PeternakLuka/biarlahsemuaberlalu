<?php
    include_once("../include/koneksi.php");
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
        header("Location: ../index.php");
    }
?>
<head>
    <title>
        Update Data | Edit
    </title>
    <style>
        .button {
            background-color: red;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s;
            transition-duration: 0.4s;
        }

        .button:hover {
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }
    </style>
</head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
    <form class="w3-container" method="post" enctype="multipart/form-data" action="upload_aksi.php">
        <h3>Import File Excel:</h3>
        <input name="filee" type="file" required="required">
        <input name="upload" type="submit" value="Import">
    </form>
    <div class="w3-container w3-green">
        <h3>Update Form</h3>
    </div>
    <form class="w3-container" action="" method="post">
        <table>
            <?php  
                while($data = mysqli_fetch_array($result)) {
                    echo "
                        <tr>
                            <td>".$data['ktkb']."</td>
                            <td><input class='w3-input w3-hover-red' type='text' name='konfirmasi[]' value=".$data['konfirmasi']."></td>
                            <td style='padding-left:30px;'><input class='w3-input w3-hover-green' type='text' name='sembuh[]' value=".$data['sembuh']."></td>
                            <td style='padding-left:30px;'><input class='w3-input w3-hover-orange' type='text' name='suspek[]' value=".$data['suspek']."></td>
                        </tr>
                    ";
                    echo "<input type='hidden' name='kd_data[]' value=".$data['kd_data'].">";
                }
            ?>
            <tr>
                <td colspan="4" align="center">
                    <br/>
                    <button class="button" type="submit" name="update"><b>Update Data</b></button>
                </td>
            </tr>
        </table>
    </form>
</body>