
var formular = document.getElementById("formaPodaci");

formular.onsubmit = function() {
    var greska = document.getElementById("greskaPodaci");
    var polje;

    // Ime - proverava da li je uneto ime
    polje = document.getElementById("imeKorisnika");
    var imeKor = polje.value.trim();

    if ( imeKor.length == 0 ) {
        greska.textContent = "Morate uneti ime !";
        return false;
    }

    var maxDuzina = polje.maxLength > 0 ? polje.maxLength : 30;

    if ( imeKor.length > maxDuzina ) {
        greska.textContent = "Predugacko ime !";
        return false;
    }

    // Prezime - proverava da li je uneto prezime
    polje = document.getElementById("prezimeKorisnika");
    var prezimeKor = polje.value.trim();

    if ( prezimeKor.length == 0 ) {
        greska.textContent = "Morate uneti prezime !";
        return false;
    }

    var maxDuzina = polje.maxLength > 0 ? polje.maxLength : 30;

    if ( prezimeKor.length > maxDuzina ) {
        greska.textContent = "Predugacko prezime !";
        return false;
    }

    // Email -  provera da li je elektronska posta ispravna
    polje = document.getElementById("email");
    var email = polje.value;
    var at = -1;
    var tacka = -1;

    for (var i = 0; i < email.length; i++) {
        var karakter = email.charAt(i);
        if ( karakter == "@" ) {
            at = i;
        }
        if ( karakter == "." ) {
            tacka = i;
        }
    }

    if ( at == -1 || at > tacka || tacka == -1 ) {
        greska.textContent = "Neispravna email adresa";
        return false;
    }

    // at = email.indexOf("@");
    // tacka = email.lastIndexOf(".");

    // Provera datuma - provera da je datum ispravno unet
    polje = document.getElementById("datumRodjenja");
    var datumRodjenja = polje.value.trim();

    if ( datumRodjenja.length > 10 ) {
        greska.textContent = "Neispravan datum";
        return false;
    }

    if ( datumRodjenja.charAt(4) != "-" && datumRodjenja.charAt(7) != "-" ) {
        greska.textContent = "Neispravan datum";
        return false;
    }
    

}


