<?php
$style = '<link rel="stylesheet" href="../assets/styles.css">';

if(!isset($_SESSION["id"])){
    echo "<script>location.href='login'</script>";
}

?>
    <!doctype html>
    <html lang="en">
    <head>
        <?=dd_head("createStatements", $style)?>
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
            <div><a href="admin" style="float: left;"><img alt="logo" class="logo_Stemadvies" src="../assets/images/StemAdvies.png"><p class="title_Stemadvies">StemAdvies</p></a>
            </div>
            <a href="login" class="loguit" style="text-decoration: unset">Uitloggen</a></div>
    </header>
    <div class="background">
        <div class="container">
            <div class="row">
                <form action="admin" method="post">
                    <div class="mx-2 crudEdit" align="center">
                        <div>Stellingen toevoegen</div>
                        <div class="row">
                            <div class="col border_right">Onderwerp</div>
                            <div class="col">
                                <input type="text" name="subject" value="" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col border_right">Stelling</div>
                            <div class="col">
                                    <input type="text" name="statement" value="" required>
                            </div>
                        </div>
                        <div class="row btn" align="center"><input type="submit" value="Opslaan"></div>
                        <input type="hidden" name="CreateStatement" value="CreateStatement">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="copyright">?? StemAdvies Alle rechten voorbehouden.</div>
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
