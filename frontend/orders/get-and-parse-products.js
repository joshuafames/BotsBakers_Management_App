export function getProducts() {
    
    fetch('/Business_Manager_App/backend/products')
    .then(response => response.json())
    .then(response_object => {
        if(response_object['data'] != 200){
            response_object['data'].forEach(function(item){
                parseProductIntoDOM(item);
            });
        }else{
            console.error('Backend response: ', response_object['code']);
        }
        
    })
    .catch(err => console.log(err))

}
// getProducts();

export function parseProductIntoDOM(product) {
    const products_container = document.querySelector('#Products');

    products_container.innerHTML += 
        `<article class="card m-2">
            <section class="description-header">
                <p class="hanging-description">
                    Quick Action  
                    <span><i class="fa fa-arrow-right"></i>   Order</span>
                </p>
            </section>
            <section class="item-name">
                <h4 class="mb-0 mt-2">`+product.name+`</h4>
                <p class="hanging-description mb-3" data-product="`+product.name+`">R
                    <span>`+product.unit_price+`</span>
                </p>
            </section>
            <section class="action-button-area d-flex">
                <button
                    class="icon btn simple-border card-order-qty-less
                    onclick="decrementValue(this)">
                        <i class="fa-regular fa-minus"></i>
                </button>
                <input
                    class="form-control nobtns bill-item-qty" 
                    type="number" 
                    name="`+product.name+`" 
                    id="product-`+product.id+`-qty" 
                    min="0" 
                    value="0">
                <button 
                    class="icon btn simple-border card-order-qty-more" 
                    onclick="incrementValue(this)">
                        <i class="fa-regular fa-add"></i>
                </button>
            </section>
        </article>`;
}