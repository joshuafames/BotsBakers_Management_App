import { fixDate } from "../utilities/js/fix-date.js";
export function getSalesSummary() {
    fetch('/Business_Manager_App/backend/product-sales')
    .then(response => response.json())
    .then(response_object => {
        if(response_object['code'] != 200){
            console.error('Backend response: ', response_object['code']);
        }else{
            parseSalesSummary(response_object['data']);
        }
    })
    .catch(err => console.log(err))
}

function parseSalesSummary(data) {
    let output = '';
    data.forEach(function(order){
        output += `
            <div class="single-table-row px-2 row" id="${order.id}">
                <div class="col-3">${fixDate(order.date)}</div>
                <div class="col-3">${order.name}</div>
                <div class="col-3">${order.unit_price}</div
                <div class="col-3 font-medium primary-grey">R${order.amount}</div>
            </div>
        `;
    });

    document.getElementById('table-list').innerHTML = output;
}
// getOrderSummary();
