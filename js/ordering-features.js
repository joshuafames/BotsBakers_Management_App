import { fixDate, convertNumToName } from "../js/fix-date.js";

var OrderedItems = 0;
var BB = false;
var WB = false;
var ROL = false;
var wBUNS = false;
var bBUNS = false;
var SOF = false;
// var orderArray = document.querySelectorAll('#card-order-qty');

// console.log(orderArray);

let Products = [0,0,0,0,0,0];

function getProducts() {
    
    fetch('./api/products')
    .then(response => response.json())
    .then(data => {
        let i = 0;
        data.forEach(function(item){
            const naam = item.Product;
            const prys = parseFloat(item.Unit_Price);
            let product = {
                name : naam,
                price : prys,
            };

            Products[i] = product;
            i++;

            var targetLMNT = document.querySelector('[data-product='+naam+']');
            
            targetLMNT.innerHTML = 'R<span>'+prys.toFixed(2)+'</span>';
            
        });

        ///document.getElementById('table-list').innerHTML = output;
    })
    .catch(err => console.log(err))

}
getProducts();


function showReceipt(){
    if(OrderedItems == 0){
        $('#place-bill').addClass('disabled');
        $('[data-qop]').addClass('disabled');

        $("#bill-items").removeClass('show');
       
        setTimeout(() => {
            $("#bill-items").addClass('hide');
        }, 500);

        setTimeout(() => {
            $("#no-items-yet").removeClass('hide');
            $("#no-items-yet").addClass('show');
            
        }, 500);
        
       
    }else{
        $('[data-qop]').removeClass('disabled');
        $('#place-bill').removeClass('disabled');

        $("#no-items-yet").removeClass('show');
        $("#no-items-yet").addClass('hide');

        $("#bill-items").removeClass('hide');
        $("#bill-items").addClass('show');
    }
}

function addItemToBill(q){
    var containerDiv = document.createElement("div");
    containerDiv.className = "single-item-order fade d-flex-space-between";
    containerDiv.setAttribute("id", q.parentElement.children[1].name);

    containerDiv.innerHTML ='<p class="font-medium">'+q.parentElement.children[1].name+'  x<span><input class="grey-text w-text-blend nobtns" name='+q.parentElement.children[1].name+' value='+q.parentElement.children[1].value+'></span></p><p class="font-medium">R<span data-prys="'+q.parentElement.children[1].name+'">'+q.parentElement.parentElement.children[1].children[1].children[0].innerHTML+'</span></p>';

    var bill = document.querySelector('#orderbill');
    bill.appendChild(containerDiv);

    setTimeout(() => {
        $('#'+q.parentElement.children[1].name).addClass('show');
    }, 100);

    if(q.parentElement.children[1].name == "BrownBread"){BB = true;}else{
        if(q.parentElement.children[1].name == "WhiteBread"){WB = true;}else{
            if(q.parentElement.children[1].name == "Rolls"){ROL = true;}else{
                if(q.parentElement.children[1].name == "Softis"){SOF = true;}else{
                    if(q.parentElement.children[1].name == "Buns"){wBUNS = true;}else{
                        if(q.parentElement.children[1].name == "BrownBuns"){bBUNS = true;}
                    }
                }
            }
        }
    }
}

function updateBill(q){

    if(document.querySelector('#'+q.parentElement.children[1].name) == null){
        addItemToBill(q);
    }else{
        document.querySelector('#'+q.parentElement.children[1].name).children[0].children[0].children[0].value = q.parentElement.children[1].value;
        let prys = parseFloat(q.parentElement.parentElement.children[1].children[1].children[0].innerHTML);
        let newAmount = prys * q.parentElement.children[1].value;
        document.querySelector('#'+q.parentElement.children[1].name).children[1].children[0].innerHTML = newAmount.toFixed(2);

        if(q.parentElement.children[1].value == 0){
            var div =  document.querySelector('#'+q.parentElement.children[1].name);
            $('#'+q.parentElement.children[1].name).removeClass('show');
            setTimeout(() => {
                div.parentElement.removeChild(div);
            }, 200);
        }
    }
    // if(q.parentElement.children[1].name == "BrownBread"){
    //     if(BB == true){
    //         document.querySelector('#BrownBread').children[0].children[0].children[0].value = q.parentElement.children[1].value;
    //         if(q.parentElement.children[1].value == 0){
    //             BB = false;
    //             var div =  document.querySelector('#BrownBread');
    //             div.parentElement.removeChild(div);
    //         }
    //     }else{
    //         addItemToBill(q);
    //     }
    // }else{
    //     if(q.parentElement.children[1].name == "WhiteBread"){
    //         if(WB == true){
    //             document.querySelector('#WhiteBread').children[0].children[0].children[0].value = q.parentElement.children[1].value;
    //             if(q.parentElement.children[1].value == 0){
    //                 WB = false;
    //                 var div =  document.querySelector('#WhiteBread');
    //                 div.parentElement.removeChild(div);
    //             }
    //         }else{
    //             addItemToBill(q);
    //         }
    //     }else{
    //         if(q.parentElement.children[1].name == "Rolls"){
    //             if(ROL == true){
    //                 document.querySelector('#Rolls').children[0].children[0].children[0].value = q.parentElement.children[1].value;
    //                 if(q.parentElement.children[1].value == 0){
    //                     ROL = false;
    //                     var div =  document.querySelector('#Rolls');
    //                     div.parentElement.removeChild(div);
    //                 }
    //             }else{
    //                 addItemToBill(q);
    //             }
    //         }else{
    //             if(q.parentElement.children[1].name == "Softis"){
    //                 if(SOF == true){
    //                     document.querySelector('#Softis').children[0].children[0].children[0].value = q.parentElement.children[1].value;
    //                     if(q.parentElement.children[1].value == 0){
    //                         SOF = false;
    //                         var div =  document.querySelector('#Softis');
    //                         div.parentElement.removeChild(div);
    //                     }
    //                 }else{
    //                     addItemToBill(q);
    //                 }
    //             }else{
    //                 if(q.parentElement.children[1].name == "Buns"){
    //                     if(wBUNS == true){
    //                         document.querySelector('#Buns').children[0].children[0].children[0].value = q.parentElement.children[1].value;
    //                         if(q.parentElement.children[1].value == 0){
    //                             wBUNS = false;
    //                             var div =  document.querySelector('#Buns');
    //                             div.parentElement.removeChild(div);
    //                         }
    //                     }else{
    //                         addItemToBill(q);
    //                     }
    //                 }else{
    //                     if(q.parentElement.children[1].name == "BrownBuns"){
    //                         if(bBUNS == true){
    //                             document.querySelector('#BrownBuns').children[0].children[0].children[0].value = q.parentElement.children[1].value;
    //                             if(q.parentElement.children[1].value == 0){
    //                                 bBUNS = false;
    //                                 var div =  document.querySelector('#BrownBuns');
    //                                 div.parentElement.removeChild(div);
    //                             }
    //                         }else{
    //                             addItemToBill(q);
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }
    let listOfPrices = document.querySelectorAll('[data-prys]');
    let BillSum = 0;
    listOfPrices.forEach(k =>{
        BillSum += parseFloat(k.innerHTML);
    });
    document.querySelector('#bill-total').innerHTML = BillSum.toFixed(2);
    document.querySelector('#bill-sub-total').innerHTML = BillSum.toFixed(2);
    document.querySelector('#bill-total-h').value = BillSum.toFixed(2);
}

export function decrementValue(q){
    if(q.parentElement.children[1].valueAsNumber > 0){
        q.parentElement.children[1].valueAsNumber = q.parentElement.children[1].valueAsNumber - 1;
        OrderedItems--;
        if(q.parentElement.children[1].name == "Brown Bread"){ orderString[0] = orderString[0] - 1}
        updateBill(q);
        showReceipt(); 
    }
     
};
export function incrementValue(q){
    q.parentElement.children[1].valueAsNumber = q.parentElement.children[1].valueAsNumber + 1;
    OrderedItems++;
    updateBill(q);
    showReceipt();
}

window.incrementValue = incrementValue;
window.decrementValue = decrementValue;


/////

var selectedOption;

function qopSelect(lmnt){    
    if(selectedOption != undefined){
        $("#"+selectedOption).removeClass("selected");
        document.querySelector('[data-qopm='+selectedOption.slice(4)+']').checked = false;
    }
    document.querySelector('[data-qopm='+lmnt.dataset.qop+']').checked = true;
    $("#"+lmnt.id).addClass("selected");
    selectedOption = lmnt.id;
};

function getOrderSummary() {
    fetch('./api/orders')
    .then(response => response.json())
    .then(data => {
        let output = '';
        var before = ["DATE", 99];
        var dayOrders = [];
        data.forEach(function(order){
            ///DATA PROCESSING
            ///ROLLS -------> NUMBER OF SALES
            ///BrownBread --> INVOICE INCOME
            ///WhiteBread --> CASH    INCOME
            ///Softis ------> CARD    INCOME

            if(before[0] == order.Date){
                var newAmount = parseInt(order.Amount) + before[1];
                dayOrders[dayOrders.length - 1].Amount = newAmount;

                dayOrders[dayOrders.length - 1].Rolls =dayOrders[dayOrders.length -1].Rolls + parseInt(order.BrownBread)+parseInt(order.WhiteBread)+parseInt(order.Rolls)+parseInt(order.Softis)+parseInt(order.BurgerBuns);

                if(order.Payment == "Invoice"){
                    dayOrders[dayOrders.length - 1].BrownBread = dayOrders[dayOrders.length - 1].BrownBread  + parseInt(order.Amount);
                }else{
                    if(order.Payment == "Cash"){
                        dayOrders[dayOrders.length - 1].WhiteBread += parseInt(order.Amount);
                    }else {
                        if(order.Payment == "Card"){
                            dayOrders[dayOrders.length - 1].Softis += parseInt(order.Amount);
                        }
                    }
                }
            }else{
                before[0] = order.Date;
                before[1]= parseInt(order.Amount);

                order.Rolls = parseInt(order.BrownBread)+parseInt(order.WhiteBread)+parseInt(order.Rolls)+parseInt(order.Softis)+parseInt(order.BurgerBuns);
                order.Date = fixDate(order.Date);

                if(order.Payment == "Invoice"){
                    order.BrownBread = parseInt(order.Amount);
                    order.WhiteBread = 0;
                    order.Softis = 0;
                }else{
                    if(order.Payment == "Cash"){
                        order.BrownBread = 0;
                        order.WhiteBread = parseInt(order.Amount);
                        order.Softis = 0;
                    }else {
                        if(order.Payment == "Card"){
                            order.BrownBread = 0;
                            order.WhiteBread = 0;
                            order.Softis = parseInt(order.Amount);
                        }
                    }
                }
                dayOrders.push(order);
            }
        });
        dayOrders.forEach(function(order){
            ////DISPLAYING DATA
            output += `
                <div class="single-table-row px-2 row" id="${order.id}">
                    <div class="col-2">${order.Date}</div>
                    <div class="col-2">${order.Rolls}</div>
                    <div class="col-2">${order.WhiteBread}</div>
                    <div class="col-3">${order.Softis}</div>
                    <div class="col-2">${order.BrownBread}</div>
                    <div class="col-1 font-medium primary-grey">R${order.Amount}</div>
                </div>
            `;
        });

        document.getElementById('table-list').innerHTML = output;
    })
    .catch(err => console.log(err))
}
getOrderSummary();
