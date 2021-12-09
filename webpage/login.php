<?php
$style = '<link rel="stylesheet" href="/assets/styles.css">';
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: /home");
}

$error = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $returned = $sqlQuery->loginUser($email);
    while($row = $returned->fetch()):
        if (password_verify($password, $row["password"])) {
            $_SESSION["id"] = $row["id"];
            header("Location: /admin");
        } else {
            $error = 1;
        }
    endwhile;
}
?>
<!doctype html>
<html lang="nl">
<head>
    <?=dd_head("Login", $style)?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../assets/styles.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Stemadvies | Login</title>
</head>
<body>
<div class="container-fluid">
    <div class="row" style="height:100vh">
        <div class="col-lg-6 container-left" style="background-color: white;">
            <div id="div_title"><p style="float: left;"><img class="logo_Stemadvies" src="../assets/images/StemAdvies.png"></p>
                <p class="title_Stemadvies">StemAdvies</p>
            </div>
            <div id="div_login">Log in</div>
            <form action="" method="post" id="formLogin">
                <label id="span_email" for="email">Email<span class="blue">*</span></label><br>
                <input class="input_text" type="text" id="email" name="email" value=""><br>
                <label id="span_password" for="password">Password<span class="blue">*</span></label><br>
                <input class="input_text" type="password" id="password" name="password" value=""><br><br>
                <input class="input_submit" type="submit" value="Log in">
            </form>
            <div id="copyright">© StemAdvies Alle rechten voorbehouden.</div>
        </div>
        <div class="col-lg-6 container-right" style="background-color: aqua">

        </div>
    </div>
</div>
</body>
</html>
<?php
