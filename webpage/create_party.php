<?php //include ("../classes/party.php")?>
<?php $style = '<link rel="stylesheet" href="../assets/styles.css">';
    if(!isset($_SESSION["id"])){
    echo "<script>location.href='login'</script>";
    }?>

<!doctype html>
<html lang="en">
<head>
    <?=dd_head("createParty", $style)?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Partij toevoegen | Stemadvies</title>

    <style>

        #container {

            width: 100%;
            margin: auto;

            display: grid;
            grid-auto-columns: 10% 10% 10% 10% 10% 10% 10% 10% 10% 10%;
            grid-auto-rows: 20% 20% 20% 20% 20%;
        }
        form{
            width: 55%;
            height: 300px;
            border: 2px solid white;
            border-radius: 11px;
            padding: 0;
            display: grid;
            grid-auto-columns: 50% 50%;
            grid-auto-rows: 16.66% 16.66% 16.66% 16.66% 16.66%;
            grid-row: 2/4;
            grid-column: 4/10;
            margin-top: 8%;
            margin-bottom: 5%;
            color: white;
            font-weight: bold;
            background-color: #0b1f8f;
            opacity: 0.75;
        }
        .form-groupStart{
            grid-row: 1;
            grid-column: 1/3;
            border: 1px solid white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            text-align: center;
            font-size: 20pt;
        }
        .form-group1{
            grid-row: 2;
            grid-column: 1;
            margin: 0;
            font-size: 14pt;
            border: 1px solid white;

        }
        .form-group2 {
            grid-row: 2;
            grid-column: 2;
            margin: 0;
            border: 1px solid white;
            font-size: 14pt;
        }
        .form-group3 {
            grid-row: 3;
            grid-column: 1;
            margin: 0;
            border: 1px solid white;
            font-size: 14pt;
        }
        .form-group4 {
            grid-row: 3;
            grid-column: 2;
            margin: 0;
            border: 1px solid white;
            font-size: 14pt;
        }
        .form-group5{
            grid-row: 4;
            grid-column: 1;
            margin: 0;
            border: 1px solid white;
            font-size: 14pt;
        }
        .form-group6{
            grid-row: 4;
            grid-column: 2;
            margin: 0;
            border: 1px solid white;
            font-size: 14pt;
        }
        .form-group7{
            grid-row: 5;
            grid-column: 1;
            margin: 0;
            border: 1px solid white;
            font-size: 14pt;
        }
        .form-group8 {
            grid-row: 5;
            grid-column: 2;
            margin: 0;
            border: 1px solid white;
            font-size: 14pt;

        }
        .form-group{
            grid-row: 6;
            grid-column: 1/3;
            margin: 0;
            border-top: 1px solid white;
            padding: 2%;

        }
        .titlebar{
            background-color: #0B1F8F;
            grid-column: 1/11;
            width: 100%;
            height:100px;
            grid-row: 1;
            display: grid;
            grid-auto-rows: 25% 25% 25% 25%;
            grid-auto-columns: 10% 10% 10% 10% 10% 10% 10% 10% 10% 10%;
            margin-bottom: 2%;
        }
        .imgLogoSA{
            width: 24%;
            border-radius: 19px;
            grid-row: 2/3;
            grid-column: 2/4;
            margin-left: -7%;
            margin-right: 4%;

        }
        .imgLogoSA:hover{
            width: 25%;
            border-radius: 19px;
            grid-row: 2/3;
            grid-column: 2/4;
            margin-left: -7%;
            margin-right: 4%;
            opacity: 0.8;
        }
        .lblTitle {
            color: white;
            font-weight: bold;
            grid-row: 2/3;
            grid-column: 2/3;
            margin-top: 4%;
            font-size: 20pt;
            margin-left: 50%;
        }

        .lblUitloggen{
            color: white;
            font-size: 20pt;
            grid-row: 2/3;
            grid-column: 9/10;
            margin-top: 4%;
            margin-left: 27%;
        }
        .lblUitloggen:hover{
            color: white;
            font-size: 21pt;
            grid-row: 2/3;
            grid-column: 9/10;
            margin-top: 4%;
            margin-left: 27%;
            opacity: 0.8;
        }
        .imgBackground{
            width: 100%;
            height: 711px;
            box-shadow: rgba(11,31,143,.62);
            grid-row: 1/6;
            grid-column: 1/11;
        }
        label {
            padding: 1%;
        }
        input[type=text],[type=file]{
        margin: 3% 3% 4% 3%;
        width: 94%;
        }
        .footerbar {
            background-color: #0B1F8F;
            grid-column: 1/11;
            width: 100%;
            height:100px;
            grid-row: 5/6;
            display: grid;
            grid-auto-rows: 25% 25% 25% 25%;
            grid-auto-columns: 10% 10% 10% 10% 10% 10% 10% 10% 10% 10%;
        }
        .lblFooterText{
            color: white;
            font-weight: bold;
            font-size: 12pt;
            grid-row: 3/4;
            grid-column: 1/4;
            width: 100%;
            margin-top: -3%;
            margin-left: 8%;
            margin-bottom: 4%;
        }


    </style>

</head>
<body>
<?php /*require_once '../classes/queryAdd.php';addQuery();*/?>
<?php
$mysqli = new mysqli('localhost', 'root', '', 'stemadviezen') or die(mysqli_error($mysqli));
$result =  $mysqli->query("SELECT * FROM party") or die($mysqli->error);
?>

<div id="container">
     <img class="imgBackground" src="../assets/images/tweede-kamer.png">
    <div class="titlebar">
        <a href="admin.php"><img class="imgLogoSA" src="../assets/images/StemAdvies.png"></a>
     <label class="lblTitle">StemAdvies</label>
        <label class="lblUitloggen" onclick="location.href='login'">Uitloggen</label>
    </div>



    <form method="post" action="">
        <div class="form-groupStart">
       <label style="text-align: center; font-weight: bold; color: white;">Partij toevoegen</label>
        </div>
            <div class="form-group1">
        <label style="opacity: 1; padding: 4% 4% 4% 6%;">Partijnaam</label>
      </div>
        <div class="form-group2">
        <input type="text" style="opacity: 1;" class="form-control" name="name" required>
      </div>
        <div class="form-group3">
        <label style="opacity: 1; padding: 4% 4% 4% 6%;;">Opgericht</label>
        </div>
        <div class="form-group4">
        <input type="text" style="opacity: 1" class="form-control" name="established" required>
        </div>
        <div class="form-group5">
        <label style="opacity: 1;padding: 4% 4% 4% 6%;;">Partijleider</label>
        </div>
        <div class="form-group6">
        <input type="text" style="opacity: 1" class="form-control" name="party_leader" required>
        </div>
        <div class="form-group7">
        <label style="opacity: 1; padding: 4% 4% 4% 6%;">Logo</label>
        </div>
        <div class="form-group8">
        <input type="file" style="opacity: 1" class="form-control" name="img" required>
        </div>

        <div class="form-group">
        <button type="submit" style="opacity: 1; margin-bottom: 2%; margin-top: -0.5%;" class="form-control" name="create" onclick="">Opslaan</button>
        </div>
    </form>
    <div class="footerbar">
        <label class="lblFooterText">?? Stemadvies Alle rechten voorbehouden.</label>
    </div>
</div>


</body>
</html>
<?php

