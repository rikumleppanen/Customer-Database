// Kun sivu on latautunut kutsutaan ready-funktion parametrina annettua funktiota
$(document).ready(function () {
    // Valitaan kaikki form-elementit, joihin liittyy destroy-form-luokka ja lisätään niihin kuuntelija, joka kutsuu parametrina annettua funktiota, kun lomake lähetetään
    $('form.destroy-form').on('submit', function (submit) {
        // Otetaan kohdelomakkeesta data-confirm-attribuutin arvo
        var confirm_message = $(this).attr('data-confirm');
        // Pyydetään käyttäjältä vahvistusta
        if (!confirm(confirm_message)) {
            // Jos käyttäjä ei anna vahvistusta, ei lähetetä lomaketta
            submit.preventDefault();
        }
    });
});

$('label').click(function () {
    var checked = $('input:checkbox', this).is(':checked');
    if ($(this).is(':contains("SELECTED")')) {
        var text = $(this).text().split('(')[0]
        $('span', this).text(checked ? text : text);
    } else {
        var text = $(this).text();
        $('span', this).text(checked ? text : text + ' (SELECTED)');
    }
    

});
//$(document).ready(function() {
//    var date = new Date();
//    
//    var day = date.getDate();
//    var month = date.getMonth();
//    var year = date.getFullYear();
//    
//    if(month < 10) month = "0" + month;
//    if(day < 10) day = "0" + day;
//    
//    var today = year + "-" + month + "-" + day;
//    $('#startdate').attr("value", today);
//});