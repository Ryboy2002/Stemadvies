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
        min-height: 1200px;
        box-shadow: inset 0 0 0 1000px rgba(11,31,143,.62);
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
$result_party = $sqlQuery->getAllParty();
$num_party = $sqlQuery->numParty();
$result_statement = $sqlQuery->getAllStatements();
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
                <?php while($row_party = $result_party->fetch()):?>
                    <div class="row">
                        <div class="col col_ID_Party border_top"><?php echo $row_party['id'];?></div>
                        <div class="col col_Party border_top"><?php echo $row_party['name'];?></div>
                        <div class="col border_top"><button><img class="icon" src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/000000/external-edit-interface-kiranshastry-solid-kiranshastry-1.png"/></button> <button><img class="icon" src="https://img.icons8.com/ios-filled/64/000000/delete.png"/></button></div>
                    </div>


                <?php endwhile;?>
                <div class="row" id="row_party_add">
                    <div class="col col_ID_Statements border_top"></div>
                    <div class="col col_Statements border_top"></div>
                    <div class="col border_top button_add"><img class="imgAdd" src="https://img.icons8.com/ios-glyphs/60/000000/plus.png"/></div>
                </div>
            </div>

            <div class="col mx-2 crud">
                <div class="row">
                    <div class="col col_ID_Statements">ID</div>
                    <div class="col col_Statements">Stelling</div>
                    <div class="col"></div>
                </div>
                <?php while($row_statement = $result_statement->fetch()):?>
                    <div class="row">
                        <div class="col col_ID_Party border_top"><?php echo $row_statement['id'];?></div>
                        <div class="col col_Party border_top"><?php echo $row_statement['subject'];?></div>
                        <div class="col border_top"><a href="editStatements?id=<?php echo $row_statement['id'];?>"><img class="icon" src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/000000/external-edit-interface-kiranshastry-solid-kiranshastry-1.png"/></a> <button><img class="icon" src="https://img.icons8.com/ios-filled/64/000000/delete.png"/></button></div>
                    </div>


                <?php endwhile;?>
                <div class="row" id="row_party_add">
                    <div class="col col_ID_Statements border_top"></div>
                    <div class="col col_Statements border_top"></div>
                    <div class="col border_top button_add"><img class="imgAdd" src="https://img.icons8.com/ios-glyphs/60/000000/plus.png"/></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var num_party = <?php echo $num_party; ?>;
    console.log(num_party);
    if (num_party > 4) {
        var element = document.getElementById("row_party_add");
        element.classList.add("hide");
    } else {
        var element = document.getElementById("row_party_add");
        element.classList.remove("hide");
    }
</script>
</body>
<footer>
    <div class="container">
        <div class="copyright">© StemAdvies Alle rechten voorbehouden.</div>
    </div>
</footer>
</html>
<?php
