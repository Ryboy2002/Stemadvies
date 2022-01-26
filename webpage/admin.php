<?php
$style = '<link rel="stylesheet" href="../assets/styles.css">';
if(!isset($_SESSION["id"])){
    echo "<script>location.href='login'</script>";
}

if (isset($_POST['CreateStatement']) && $_POST['CreateStatement'] == 'CreateStatement') {
    $result = $sqlQuery->createStatement($_POST['subject'],$_POST['statement']);
}

if (isset($_POST['CreateParty']) && $_POST['CreateParty'] == 'CreateParty') {

    $target_dir = __DIR__."/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // echo  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            /* echo "File is an image - " . $check["mime"] . ".";*/
            $uploadOk = 1;
        } else {
            /* echo "File is not an image.";*/
            $uploadOk = 0;
        }
    }

// Check if file already exists
    if (file_exists($target_file)) {
        /*  echo "Sorry, file already exists.";*/
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        /* echo "Sorry, your file is too large.";*/
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        /*  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";*/
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        /*echo "Sorry, your file was not uploaded.";*/
// if everything is ok, try to uploads file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            /* echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";*/
        } else {
            /* echo "Sorry, there was an error uploading your file.";*/
        }
    }

    if ($uploadOk == 1 & isset($_FILES)) {
        $result = $sqlQuery->createParty($_POST['partyname'],$_POST['established'],$_POST['partyleader'], basename($_FILES["fileToUpload"]["name"]));

    } else {
        $result = $sqlQuery->createWithoutImageParty($_POST['partyname'],$_POST['established'],$_POST['partyleader']);
    }

}


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
        <div><a href="admin" style="float: left;"><img alt="logo" class="logo_Stemadvies" src="../assets/images/StemAdvies.png"><p class="title_Stemadvies">StemAdvies</p></a>
        </div>
        <a href="login" class="loguit" style="text-decoration: unset">Uitloggen</a></div>
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

            <div class="col mx-2 crud no-scrollbar" style="overflow-y: scroll; overflow-x: auto">
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
                        <div class="col border_top"><a href="editParty?id=<?=$row['id']?>"><img class="imgAdd" src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/000000/external-edit-interface-kiranshastry-solid-kiranshastry-1.png"/></a> <button onclick="deleteRowParty(<?=$row['id']?>)" class="buttonStyleHide"><img class="icon" src="https://img.icons8.com/ios-filled/64/000000/delete.png"/></button></div>
                    </div>


                <?php endwhile;?>
                <div class="row" id="row_party_add">
                    <div class="col col_ID_Statements border_top"></div>
                    <div class="col col_Statements border_top"></div>
                    <div class="col border_top button_add"><a href="createParty" class="imgAdd"><img src="https://img.icons8.com/ios-glyphs/60/000000/plus.png"/></a></div>
                </div>
            </div>

            <div class="col mx-2 crud no-scrollbar" style="overflow-y: scroll; overflow-x: auto">
                <div class="row">
                    <div class="col col_ID_Statements">ID</div>
                    <div class="col col_Statements"></div>
                    <div class="col"></div>
                </div>
        <?php while($row = $resultStatements->fetch()):?>

            <div class="row">
                    <div class="col col_ID_Statements border_top"><?php echo $row['id'];?></div>
                    <div class="col w-70 col_Statements border_top"><?php echo $row['subject'];?></div>
                    <div class="col border_top">
                        <a href="editStatements?id=<?=$row['id']?>"><img class="imgAdd" src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/000000/external-edit-interface-kiranshastry-solid-kiranshastry-1.png"/></a><button onclick="deleteRowStatement(<?=$row['id']?>)" class="buttonStyleHide"><img class="icon" src="https://img.icons8.com/ios-filled/64/000000/delete.png"/></button>
                    </div>
                </div>

        <?php endwhile;?>
                <div class="row" id="row_party_add">
                    <div class="col col_ID_Statements border_top"></div>
                    <div class="col col_Statements border_top"></div>
                    <div class="col border_top button_add"><a href="createStatements" class="imgAdd"><img src="https://img.icons8.com/ios-glyphs/60/000000/plus.png"/></a></div>
                </div>
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

    function deleteRowParty(id){
        data = {
            "postID": id,
        }
        var opts = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'content-type': 'application/json'
            },
        };
        fetch('/requests/deleteParty.php', opts).then(response => response.json())
            .then(data =>{
                    console.log(data)
                }

            );
        //document.location.reload();
    }

    function deleteRowStatement(id){
        data = {
            "postID": id,
        }
        var opts = {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'content-type': 'application/json'
            },
        };
        fetch('/requests/deleteStatement.php', opts).then(response => response.json())
            .then(data =>{
                    console.log(data)
                }

            );
       // document.location.reload();
    }
</script>
</body>
</html>
<?php
