$('#record-daily-sales form').submit(function(e){
    e.preventDefault();

    console.log($('#daily-card-sales input'));
    console.log($('#daily-cash-sales input'));
    console.log($('#daily-vendor-sales input'));

    if(document.querySelector("#daily-card-sales input").value == ''){
        if(document.querySelector("#daily-cash-sales input").value == ''){
            if(document.querySelector("#daily-vendor-sales input").value == ''){
                console.log("errr");
            }
        }
    } else{
        console.log("okay");
    
    // $.ajax({
    //     url: '',
    //     method: 'post',
    //     data: $(this).serialize(),
    //     success:function(response){
    //         console.log(response);
    //         $('#create-invoice').modal('hide');
    //         $('#success-modal').modal('show');
    //     }
    // });
    }
});

