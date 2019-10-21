
var formular = document.getElementById("formaPrijava");

formular.onsubmit = function() {
    var greska = document.getElementById("greska");
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

    // Korisnicko ime - provera da li se korisnicko sastoji od malih
    //                  i velikih slova
    polje = document.getElementById("username");
    var korisnickoIme = polje.value.trim();

    if ( korisnickoIme.length == 0 ) {
        greska.textContent = "Morate uneti korisnicko ime !!!";
        return false;
    }

    for (var i = 0; i < korisnickoIme.length; i++) {
        var karakter = korisnickoIme.charAt(i);
        if ( !(karakter >= 'a' && karakter <= 'z') && !(karakter >= 'A' && karakter <= 'Z') ) {
            greska.textContent = "Nedozvoljeni karakter u korisnickom imenu !!!";
            return false;
        }
    }

    // Sifra -  provera da li sifra ima jedno veliko i malo slovo i jednu cifru u sebi
    //          i da li je minimalne duzine 8 znakova
    polje = document.querySelector("#password");
    var sifra = polje.value;

    if ( sifra.length < 8 ) {
        greska.textContent = "Prekratka sifra !";
        return false;
    }

    var malaSlova = new Array();
    var velikaSlova = new Array();

    for(var i = 0; i < 26; i++) {
        malaSlova.push(String.fromCharCode(97+i));
        velikaSlova.push(String.fromCharCode(65+i));
    }

    var cifre = "0123456789";
    var imaMalo = false;
    var imaVeliko = false;
    var imaCifru = false;

    for (var i = 0; i < sifra.length; i++) {
        var karakter = sifra.charAt(i);

        if ( malaSlova.indexOf(karakter) > -1 ) {
            imaMalo = true;
        } else if ( velikaSlova.indexOf(karakter) >= 0 ) {
            imaVeliko = true;
        } else if ( cifre.indexOf(karakter) >= 0 ) {
            imaCifru = true;
        }

    }

    if ( !imaMalo || !imaVeliko || !imaCifru ) {
        greska.textContent = "Slaba sifra !";
        return false;
    }

}

formular.onreset = function() {
    var prozor = confirm("Da li ste sigurni ?");
    return prozor;
}
