$(document).ready(function(){
    //ajax ish
    $('#addinvoice').submit(function(e){
        e.preventDefault();

        $('#create-invoice').modal('hide');

        document.querySelector('#snack-bar-body').innerText = "Generating New Invoice";
        document.querySelector('.snackbar').classList.add("visible");
        
        $.ajax({
            url: './documents/invoices/invoiceAction.php',
            method: 'post',
            data: $(this).serialize(),
            success:function(response){
                document.querySelector('.snackbar').classList.remove("visible");
                console.log("ALL SHOULD BE WELL");
                $('#success-modal').modal('show');
            },
            error:function(response) {
                console.log(response);
            }            
        });
        
    });

});