
var formular = document.getElementById("formaPodaci");

formular.onsubmit = function() {
    var greska = document.getElementById("greskaPodaci");
    var polje;

    // Provera datuma - provera da je datum ispravno unet
    polje = document.getElementById("datumRodjenja");
    var datumRodjenja = polje.value.trim();

    if ( datumRodjenja.length > 10 ) {
        greska.textContent = "Neispravan datum!";
        return false;
    }

    if ( datumRodjenja.charAt(4) != "-" && datumRodjenja.charAt(7) != "-" ) {
        greska.textContent = "Neispravan datum!";
        return false;
    }
    
    polje = document.getElementById("pol");
    var pol = polje.value.trim();

    if ( pol !== 'm' && pol !== 'z' && pol != 'M' && pol !='Z' ) {
        greska.textContent = "Neispravan pol!";
        return false;
    }

}


