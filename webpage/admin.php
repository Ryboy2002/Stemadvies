<?php
$style = '<link rel="stylesheet" href="../assets/styles.css">';
?>
<!doctype html>
<html lang="en">
<head>
    <?=dd_head("Admin", $style)?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stemadvies | Admin</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<style>
    body {
        background-image: url("../assets/images/background.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: left top;
    }
</style>
<body>

<header>
<div class="container">
    <div><p style="float: left;"><img class="logo_Stemadvies" src="../assets/images/StemAdvies.png"></p>
        <p class="title_Stemadvies">StemAdvies</p>
    </div>
    <button class="loguit">Uitloggen</button></div>
</div>
</header>
<?php
$result = $sqlQuery->getAllParty();
$num_party = $sqlQuery->numParty();
$resultStatements = $sqlQuery->getAllStatements();

//$deletePartyRow = $sqlQuery->deletePartyRow();
 ?>

<div class="background">
    <div class="container">
      <div class="row">

            <div class="col mx-2 crud">
                <div class="row">
                    <div class="col col_ID_Party">ID</div>
                    <div class="col col_Party">Partij</div>
                    <div class="col"></div>
                </div>
                <?php while($row = $result->fetch()):?>
                    <div class="row">
                        <div class="col col_ID_Party border_top"><?php echo $row['id'];?></div>
                        <div class="col col_Party border_top"><?php echo $row['name'];?></div>

                        <?php $id = $row['id'] ?>
                    <?php /*$deleteParty = $sqlQuery->deletePartyRow($id) */?>
                        <div class="col border_top"><button onclick=""><img class="icon" src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/000000/external-edit-interface-kiranshastry-solid-kiranshastry-1.png"/></button> <button><img class="icon" src="https://img.icons8.com/ios-filled/64/000000/delete.png"/></button></div>
                    </div>


                <?php endwhile;?>
                <div class="row" id="row_party_add">
                    <div class="col col_ID_Statements border_top"></div>
                    <div class="col col_Statements border_top"></div>
                    <div class="col border_top button_add"><img class="imgAdd" src="https://img.icons8.com/ios-glyphs/60/000000/plus.png"/></div>
                </div>
            </div>

            <div class="col mx-2 crud" style="overflow-y: scroll; overflow-x: auto">
                <div class="row">
                    <div class="col col_ID_Statements">ID</div>
                    <div class="col col_Statements"></div>
                    <div class="col"></div>
                </div>
        <?php while($row = $resultStatements->fetch()):?>

            <div class="row">
                    <div class="col col_ID_Statements border_top"><?php echo $row['id'];?></div>
                    <div class="col col_Statements border_top"><?php echo $row['subject'];?></div>
                    <div class="col border_top">
                        <a href="editStatements?id=<?=$row['id']?>"><img class="imgAdd" src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/000000/external-edit-interface-kiranshastry-solid-kiranshastry-1.png"/></a>
                    </div>
                </div>

        <?php endwhile;?>
            </div>
        </div>
    </div>
</div>
<footer>
<div class="container">
    <div class="copyright">© StemAdvies Alle rechten voorbehouden.</div>
</div>
</footer>
<script type="text/javascript">
    var num_party = <?php echo $num_party; ?>;
    console.log(num_party);
    if (num_party > 4) {
        var element = document.getElementById("row_party_add");
        element.classList.add("hide");
    } else {
         element = document.getElementById("row_party_add");
        element.classList.remove("hide");
    }



</script>
</body>
</html>
<?php
