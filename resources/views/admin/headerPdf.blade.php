<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .kop {
            margin: 0 auto;
            width: 400px;
            /* border: 1px solid black; */
        }

        .img-header {
            width: 180px;
            height: auto;
            margin-right: 20px;
        }

        .kop td {
            margin: 0;
            padding: 0 10px;
            font-size: 10px;
            text-align: center;
            /* color: #007bf7; */
        }
    </style>

</head>

<body>
    <div align="center">
        <img src="data:image/jpeg;base64,{{ base64_encode(@file_get_contents(url('https://ik.imagekit.io/prbydmwbm8c/logo_SpJLMNBG_.png'))) }}" class="img-header" alt="logo stikom">
    </div>
    <table class="kop">
        <td>
            Alamat: Jl. Pratama no. 104, Tanjung Benoa (CENTRAL PARKING)
        </td>
    </table>
    <table class="kop">
        <td>
            No. Tlp: 081916404488
        </td>
    </table>
    <table class="kop">
        <td>
            Email: pandansari569@gmail.com
        </td>
    </table>
    <hr style="width: 80%">
</body>

</html>