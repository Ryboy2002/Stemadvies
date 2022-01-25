<?php
$style = '<link rel="stylesheet" href="../assets/styles.css">';

$statement_ID = $_GET['id'];
if (isset($_POST['EditPartyOpinion']) && $_POST['EditPartyOpinion'] == 'EditPartyOpinion') {
    $result = $sqlQuery->editPartyOpinion($_POST['opinion'], $_POST['reason'],$_POST['party'], $statement_ID);
    echo "<script>location.href='admin';</script>";
}

$result_reason = $sqlQuery->getAllReasons($_GET['id']);

$reasonArray = Array();
while($row_statement = $result_reason->fetch()):
        $reasonRow = Array();
        array_push($reasonRow,$row_statement['name'], $row_statement['opinion'], $row_statement['reason'], $row_statement['partyid']);
        array_push($reasonArray,$reasonRow);
        unset($reasonRow);
endwhile;
?>
    <!doctype html>
    <html lang="en">
    <head>
        <?=dd_head("editPartyOpinion", $style)?>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Stemadvies | Edit Statement</title>
        <link rel="stylesheet" href="../assets/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <style>
        body {
            background-image: url("../assets/images/background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: left top;
            box-shadow: inset 0 0 0 1000px rgba(11,31,143,.62);
        }
    </style>
    <body>

    <header>
        <div class="container">
            <div><p style="float: left;"><img class="logo_Stemadvies" src="../assets/images/StemAdvies.png"></p>
                <p class="title_Stemadvies">StemAdvies</p>
            </div>
            <a href="login" class="loguit" style="text-decoration: unset">Uitloggen</a></div>
    </header>
    <?php
    $result_Statement = $sqlQuery->getStatement($_GET['id']);
    $result_party_names = $sqlQuery->nameParty();
    ?>
    <div class="background">
        <div class="container">
            <div class="row">
                <form action="" id="formPartyOpinion" method="post">
                    <div class="mx-2 crudEdit" align="center">
                        <div><?php while($row_Statement = $result_Statement->fetch()):?>
                                <?=$row_Statement['subject'];?>
                            <?php endwhile;?></div>

                        <div class="row">
                            <div class="col border_right">Partij</div>
                            <div class="col">
                                <select id="party" name="party" onchange="ChangeValue()" form="formPartyOpinion">
                                    <option value="" selected disabled hidden>Kies partij</option>
                                    <?php while($row_statement = $result_party_names->fetch()):?>
                                    <?php echo '<option value="'.$row_statement["id"].'">'.$row_statement["name"].'</option>'; ?>
                                    <?php endwhile;?>
                                </select>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col border_right">Partijmening</div>
                             <div class="col">
                                <select id="opinion" name="opinion" form="formPartyOpinion">
                                    <option value="0">Geen mening</option>
                                    <option value="1">Eens</option>
                                    <option value="2">Neutraal</option>
                                    <option value="3">Oneens</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col border_right">Toelichting</div>
                            <div class="col"><input id="reason" name="reason" type="text"></div>
                        </div>
                        <div class="row btn" align="center"><input type="submit" value="Opslaan"></div>
                        <input type="hidden" name="EditPartyOpinion" value="EditPartyOpinion">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="copyright">© StemAdvies Alle rechten voorbehouden.</div>
        </div>
    </footer>
    <script type="text/javascript">
        $('#button').click(function(){
            $("input[type='file']").trigger('click');
        })

        $("input[type='file']").change(function(){
            $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
        })
        var passedArray =
            <?php echo json_encode($reasonArray); ?>;
        function ChangeValue() {
            var e = document.getElementById("party");
            var strUser = e.value;

            for(var i = 0; i < passedArray.length; i++) {
                if (strUser == passedArray[i][3]) {
                      document.getElementById("opinion").value = passedArray[i][1];
                    document.getElementById("reason").value = passedArray[i][2];
                }
            }
        }
    </script>
    </body>
    </html>
<?php
