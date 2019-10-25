
var formular = document.getElementById("promenaLozinke");
// var parola = document.querySelector("#greskaLozinka");
// parola.value = "USAO SAM U JAVASCRIPT";
// var nsif = document.getElementById("novaSifra");
// nsif.value = "Ovo je proba";

formular.onsubmit = function() {
    var greska = document.getElementById("greskaLozinka");
    var polje;

    // Ime - proverava da li je uneto ime
    polje = document.getElementById("imeKorisnikaLozinka");
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
    polje = document.getElementById("prezimeKorisnikaLozinka");
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
    polje = document.getElementById("emailLozinka");
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

    // Sifra -  provera da li sifra ima jedno veliko i malo slovo i jednu cifru u sebi
    //          i da li je minimalne duzine 8 znakova
    polje = document.getElementById("novaSifra");
    var novaLozinka = polje.value.trim();
    polje = document.getElementById("novaSifraOpet");
    var novaLozinkaOpet = polje.value.trim();

    if ( novaLozinka.length < 8 ) {
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

    for (var i = 0; i < novaLozinka.length; i++) {
        var karakter = novaLozinka.charAt(i);

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

    if ( novaLozinka !== novaLozinkaOpet ) {
        greska.textContent = "Lozinke se ne podudaraju !";
        return false;       
    }
    
    

}




