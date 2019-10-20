<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Autor prezentacije i alat koji je koristen za izradu prezentacije -->
    <meta name="authors" content="Dragica Radivojevic, Ranko Korlat i Dejan Kumric">
    <meta name="generator" content="Visual Studio Code">

    <!-- Za izradu prezentacije koristi se lokalna kopija Bootstrap-a 4. -->
    <link rel="stylesheet" type="text/css" href="./bootstrap/bootstrap.css">
    <!-- I koristim besplatne Font Awesome fontove za znak brenda. -->
    <link rel="stylesheet" href="./fontawesome/css/all.css">
    <!-- Moji stilovi -->
    <link rel="stylesheet" type="text/css" href="./css/nasiStilovi.css">

    <!-- Neophodni skriptovi jQuery, popper.js i bootstrap.js-->
    <script src="./jquery/jquery-3.4.1.js"></script>
    <script src="./popper/popper.js"></script>
    <script src="./js/bootstrap.js"></script>

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Registration page </title>
</head>
<body>
   
    <div class="masthead">
    </div>
    <!-- NAVIGACIONI BAR - Bootswatch - tema Sandstone -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <!-- <a class="navbar-brand" href="#"> Navbar </a> -->
        <a class="navbar-brand" href="index.php"> <i class="fas fa-utensils"></i> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php"> Početna <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./glavnaJela.php"> Glavna jela </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./predjela.php"> Predjela </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./supeIcorbe.php"> Supe i čorbe </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./kolaci.php"> Kolači </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./torte.php"> Torte </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./salate.php"> Salate </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="registration.php"> Registracija </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="sign_up" href="./login.html"> Prijava </a>
                </li>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"> Search </button>
            </form> -->
        </div>
    </nav>

    <div class="container mt-5 pt-5">

        <h1 class="text-center mb-5 pb-4"> <strong> Registration form </strong> </h1>

        <form id="formaPrijava" class="col-md-6 mx-auto" action="" style="background-color: rgb(221, 229, 230)">
            <fieldset>
                <legend style="text-align: center"> Registration </legend>
                <div class="form-group">
                    <label for="imeNaloga"> Username: </label>
                    <input class="form-control" type="text" name="imeNaloga" id="imeNaloga">
                </div>
                <div class="form-group">
                    <label for="sifra"> Password: </label>
                    <input class="form-control" type="text" name="sifra" id="sifra">
                </div>
                <div class="form-group">
                    <label for="imeKorisnika"> Ime: </label>
                    <input class="form-control" type="text" name="imeKorisnika" id="imeKorisnika">
                </div>
                <div class="form-group">
                    <label for="prezimeKorisnika"> Prezime: </label>
                    <input class="form-control" type="text" name="prezimeKorisnika" id="prezimeKorisnika">
                </div>
                <div class="form-group">
                    <label for="elAdresa"> Email: </label>
                    <input class="form-control" type="text" name="elAdresa" id="elAdresa">
                </div>
                <div class="form-group pt-3">
                    <button type="submit" class="btn btn-primary"> Submit </button>
                    <span class="float-right"> Zaboravili ste šifru ? </span>
                </div>
            </fieldset>
        </form>

    </div>

</body>
</html>