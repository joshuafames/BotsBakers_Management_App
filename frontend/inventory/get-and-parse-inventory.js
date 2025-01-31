export function getInventorySummary() {
    fetch('/Business_Manager_App/backend/inventory')
    .then(response => response.json())
    .then(response_object => {
        if(response_object['code'] != 200){
            console.error('Backend response: ', response_object['code']);
        }else{
            parseInventorySummary(response_object['data']);
        }
    })
    .catch(err => console.log(err))
}

function parseInventorySummary(data) {
    let output = '';
    data.forEach(function(item){
        output += `
            <div class="single-table-row px-2 row" id="STOCK${item.id}">
                <div class="col-3">${item.item_name}</div>
                <div class="col-3">${item.cost}</div>
                <div class="col-3">${item.count}</div>
                <div class="col-3">*</div>
            </div>
        `;
    });

    document.getElementById('inventory-table-list').innerHTML = output;
}
// getOrderSummary();
