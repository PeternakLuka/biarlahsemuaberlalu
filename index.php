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
                text-align: center;
                font-size: 20px;
            }

            .grid-container2 {
                display: grid;
                grid-template-columns: auto auto auto auto;
            }
        </style>
    </head>
    <body>
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
            <div class="461">DATA COVID-19 PROVINSI JATIM</div>
            <div class="462">DATA COVID-19 KOTA MALANG</div>
        </div>
        <div class="grid-container2">
            <div class="patnam1">
                <table border="1">
                    <tr>
                        <td>Kota/Kabupaten</td>
                        <td>Konfirmasi</td>
                        <td>Sembuh</td>
                        <td>Suspect</td>
                    </tr>
                </table>
            </div>
            <div class="patnam2">
                <table border="1">
                    <tr>
                        <td>Kota/Kabupaten</td>
                        <td>Konfirmasi</td>
                        <td>Sembuh</td>
                        <td>Suspect</td>
                    </tr>
                </table>
            </div>
            <div class="patnam3">Foto Col 1<br/>Row 1 & 2</div>  
            <div class="patnam4">Foto Col 2<br/>Row 1 & 2</div>
        </div>
    </body>
</html>


<!-- <title>
    Update Percepatan Virus COVID-19 Kota Malang
</title>
<body>
    <table width="100%">
        <tr>
            <td colspan="2">Header Kiri</td>
            <td colspan="2" align="right">Header Kanan</td>
        </tr>
        <tr>
            <td align="center">Positif</td>
            <td align="center">Sembuh</td>
            <td align="center">Meninggal</td>
            <td align="center">Malang Raya</td>
        </tr>
        <tr>
            <td><br/></td>
            <table width="100%">
                <tr>
                    <td colspan="2" align="center"><strong>DATA COVID-19 PROVINSI JATIM</strong></td>
                    <td colspan="2" align="center"><strong>DATA COVID-19 KOTA MALANG</strong></td>
                </tr>
                <tr>
                    <td>
                        <tr>
                            <td>KOTA/KABUPATEN</td>
                            <td>KONFIRMASI</td>
                            <td>SEMBUH</td>
                            <td>SUSPECT</td>
                        </tr>
                    </td>
                    <td>
                        KOTA/KABUPATEN 2
                    </td>
                    <td>
                        Foto 1
                    </td>
                    <td>
                        FOTO 2
                    </td>
                </tr>
            </table>
        </tr>
    </table>
</body> -->