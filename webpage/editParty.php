<?php
$style = '<link rel="stylesheet" href="../assets/styles.css">';

if(!isset($_SESSION["id"])){
    echo "<script>location.href='login'</script>";
}

$statement_ID = $_GET['id'];
if (isset($_POST['EditParty']) && $_POST['EditParty'] == 'EditParty') {

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
        $result = $sqlQuery->editParty($_POST['partyname'],$_POST['established'],$_POST['partyleader'], basename($_FILES["fileToUpload"]["name"]), $statement_ID);

    } else {
        $result = $sqlQuery->editWithoutImageParty($_POST['partyname'],$_POST['established'],$_POST['partyleader'], $statement_ID);
    }
   //header('Location: /admin');
    //exit;
}


?>
    <!doctype html>
    <html lang="en">
    <head>
        <?=dd_head("editParty", $style)?>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Stemadvies | Edit Party</title>
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
            <div><a href="admin" style="float: left;"><img alt="logo" class="logo_Stemadvies" src="../assets/images/StemAdvies.png"><p class="title_Stemadvies">StemAdvies</p></a>
            </div>
            <a href="login" class="loguit" style="text-decoration: unset">Uitloggen</a></div>
    </header>
    <?php
    $result_Statement = $sqlQuery->getParty($_GET['id']);
    ?>
    <div class="background">
        <div class="container">
            <div class="row">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mx-2 crudEdit" align="center">
                        <div>Stellingen wijzigen</div>
                        <?php while($row_Statement = $result_Statement->fetch()):?>
                        <div class="row">
                            <div class="col border_right">Partijnaam</div>
                            <div class="col">
                                <input type="text" name="partyname" value="<?=$row_Statement['name']?>">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col border_right">Opgericht</div>
                            <div class="col">
                                    <input type="text" name="established" value="<?=$row_Statement['established']?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col border_right">Partijleider</div>
                            <div class="col">
                                <input type="text" name="partyleader" value="<?=$row_Statement['party_leader']?>">
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-6 border_right">Logo</div>

                                <div class="col-6">

                                    <input id="inputPartyLogo" disabled type="text" name="logo" value="<?=$row_Statement['img']?>">
                                </div>
                                <div class="col-6">
                                    <button type="button" onclick="deletePartyImg(<?=$row_Statement['id']?>)" id="btnDeleteImg">Delete</button>
                               <!--     <input type="hidden" name="btnDelete" value="btnDelete">-->
                                </div>

                                <div class="col-6">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                            </div>
                        <?php endwhile;?>
                        <div class="row btn" align="center"><input type="submit" value="Opslaan"></div>
                        <input type="hidden" name="EditParty" value="EditParty">

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

        function deletePartyImg(id) {
            // document.getElementById("inputPartyLogo").innerHTML = "";
            location.reload();
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
            fetch('/requests/deleteImg.php', opts).then(response => response.json())
                .then(data =>{
                        console.log(data)


                    }

                );

        }

    </script>
    </body>
    </html>
<?php
