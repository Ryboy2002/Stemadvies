<?php
$style = '<link rel="stylesheet" href="../assets/styles.css">';

$statement_ID = $_GET['id'];
if (isset($_POST['EditStatement']) && $_POST['EditStatement'] == 'EditStatement') {
$result = $sqlQuery->editStatement($_POST['subject'],$_POST['statement'],$statement_ID);



    $target_dir = __DIR__."/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    echo  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

}


?>
    <!doctype html>
    <html lang="en">
    <head>
        <?=dd_head("editStatements", $style)?>
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
            <div><p style="float: left;"><img class="logo_Stemadvies" src="../assets/images/StemAdvies.png"></p>
                <p class="title_Stemadvies">StemAdvies</p>
            </div>
            <button class="loguit">Uitloggen</button></div>
        </div>
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
                                <input type="text" name="subject" value="<?=$row_Statement['name']?>">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col border_right">Opgericht</div>
                            <div class="col">
                                    <input type="text" name="statement" value="<?=$row_Statement['established']?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col border_right">Partijleider</div>
                            <div class="col">
                                <input type="text" name="statement" value="<?=$row_Statement['party_leader']?>">
                            </div>
                        </div>
                            <div class="row">
                                <div class="col border_right">logo</div>
                                <div class="col">
                                    <input disabled type="text" name="statement" value="<?=$row_Statement['img']?>">
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                            </div>
                        <?php endwhile;?>
                        <div class="row btn" align="center"><input type="submit" value="Opslaan"></div>
                        <input type="hidden" name="EditStatement" value="EditStatement">

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
    </script>
    </body>
    </html>
<?php
