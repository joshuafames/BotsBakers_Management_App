import { fixDate, convertNumToName } from "../utilities/js/fix-date.js";

var OrderedItems = 0;
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

    containerDiv.innerHTML =
        `<p class="font-medium">
            `+q.parentElement.children[1].name+`  x
            <span>
                <input 
                    class="grey-text w-text-blend nobtns" 
                    name=`+q.parentElement.children[1].name+` 
                    value=`+q.parentElement.children[1].value+`>
            </span>
        </p>
        <p class="font-medium">
            R
            <span 
                data-prys="`+q.parentElement.children[1].name+`">
                    `+q.parentElement.parentElement.children[1].children[1].children[0].innerHTML+`
            </span>
        </p>`
    ;

    var bill = document.querySelector('#orderbill');
    bill.appendChild(containerDiv);

    const new_bill_item = document.getElementById(q.parentElement.children[1].name);
    setTimeout(() => {
        new_bill_item.classList.add('show');
    }, 100);
}

export function clearBill() {
    OrderedItems = 0;
    showReceipt();
    const bill_message = document.querySelector('#bill-message');
    const order_bill = document.querySelector('#orderBill');
    order_bill.innerHTML = '';
    bill_message.innerHTML = 'Sale Recorded!';
}

function updateBill(q){
    const bill_item = document.getElementById(q.parentElement.children[1].name);

    //CHECK IF BILL HAS THIS ITEM ALREADY
    if(bill_item == null){
        addItemToBill(q);
    }else{
        bill_item.children[0].children[0].children[0].value = q.parentElement.children[1].value;

        let prys = parseFloat(q.parentElement.parentElement.children[1].children[1].children[0].innerHTML);
        let newAmount = prys * q.parentElement.children[1].value;
        
        bill_item.children[1].children[0].innerHTML = newAmount.toFixed(2);

        // REMOVE BILL ITEM IF QUANTITY IS ZERO
        if(q.parentElement.children[1].value == 0){
            bill_item.classList.remove('show');
            setTimeout(() => {
                bill_item.parentElement.removeChild(bill_item);
            }, 200);
        }
    }
    
    // CALCULATE BILL TOTAL
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

