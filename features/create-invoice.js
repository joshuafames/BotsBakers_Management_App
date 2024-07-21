const switchToErrorSnackbar = (snackbar_component, snackbar_title, snackbar_body, desc_error) => {
    snackbar_component.classList.remove('info');
    snackbar_component.classList.add('error');
    snackbar_title.innerText = "Error";
    snackbar_body.innerText = desc_error;
}

const switchToInfoSnackbar = (snackbar_component, snackbar_title, snackbar_body, title, body) => {
    snackbar_component.classList.remove('error');
    snackbar_component.classList.add('info');
    snackbar_title.innerText = title;
    snackbar_body.innerText = body;
}

const cleanUpSnackbar = (snackbar_component) => {
    snackbar_component.classList.remove('info');
    snackbar_component.classList.remove('error');
}

$(document).ready(function(){
    const snackbar_title = document.querySelector('#snack-bar-title');
    const snackbar_body = document.querySelector('#snack-bar-body');
    const snackbar_component = document.querySelector('.snackbar');

    //ajax ish
    $('#addinvoice').submit(function(e){
        e.preventDefault();

        $('#create-invoice').modal('hide');
        snackbar_component.classList.add("info");
        switchToInfoSnackbar(snackbar_component, snackbar_title, snackbar_body, "Creating invoice", "Generating invoice pdf file & recording data to database");
        snackbar_component.classList.add('visible');
        
        $.ajax({
            url: './documents/invoices/generateInvoice.php',
            method: 'post',
            data: $(this).serialize(),
            success:function(response){
                console.log("Point: AJAX SUCCESS");
                console.log(response);
                if(response === "200") {
                    ///200 MEANS OK
                    //ACTION: CLOSE SNACKBAR, POP OPEN THE SUCCESS MODAL
                    snackbar_component.classList.remove("visible");
                    $('#success-modal').modal('show');
                }else if (response === "500"){
                    //ACTION: UPDATE THE SNACKBAR TO ALERT USER OF AN ERROR
                    switchToErrorSnackbar(snackbar_component, snackbar_title, snackbar_body, "Couldn't record to database");
                    console.log("response");
                }else{
                    switchToErrorSnackbar(snackbar_component, snackbar_title, snackbar_body, "Something went wrong");
                    console.log(response);
                }
            },
            error:function(response) {
                console.log(response);
            }            
        });
        cleanUpSnackbar(snackbar_component);
        
    });

});