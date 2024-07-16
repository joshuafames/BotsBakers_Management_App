
export function getClients(client="") {
    fetch('./backend/get-clients'+client)
    .then(response => response.json())
    .then(data => {
        let output = '';
        data.forEach(function(client){
            output += `
            <a class="single-table-row px-2 row" href="./client.php?client=${client.name}">
                <div class="table-col col-3">${client.id}</div>
                <div class="table-col col-3">${client.name}</div>
                <div class="table-col col-3">${client.num_orders}</div>
                <div class="table-col col-3">${client.contact}</div>
            </a>
            `;
        });
        document.getElementById('client-list').innerHTML = output;
    })
    .catch(err => console.log(err))
}

window.getClients = getClients;