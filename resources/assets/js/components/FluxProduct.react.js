var React = require('react');
var FluxCartActions = require('../actions/FluxCartActions');
var CartStore = require('../stores/CartStore');
var ProductStore = require('../stores/ProductStore');


function getProductState() {
  return {
    product: ProductStore.getProduct(),
    selectedProduct: ProductStore.getSelected(),
    cartItems: CartStore.getCartItems(),
  };
}


// Flux product view
var FluxProduct = React.createClass({

  getInitialState: function() {
    return getProductState();
  },

  // Add item to cart via Actions
  addToCart: function(event){
    var sku = this.state.selectedProduct.sku;
    var update = {
      name: this.state.product.name,
      type: this.state.selectedProduct.type,
      price: this.state.selectedProduct.price
    }
    FluxCartActions.addToCart(sku, update);
    FluxCartActions.updateCartVisible(true);
  },

  // Select product variation via Actions
  selectVariant: function(event){
    FluxCartActions.selectProduct(event.target.value);
  },


  // Add change listeners to stores
  componentDidMount: function() {
    ProductStore.addChangeListener(this._onChange);
  },

  // Remove change listers from stores
  componentWillUnmount: function() {
    ProductStore.removeChangeListener(this._onChange);
  },

  // Render product View
  render: function() {
    var ats = (this.state.selectedProduct.sku in this.state.cartItems) ?
      this.state.selectedProduct.inventory - this.state.cartItems[this.state.selectedProduct.sku].quantity :
      this.state.selectedProduct.inventory;
    return (
      <div className="flux-product">
        <img src={'img/' + this.state.product.image}/>
        <div className="flux-product-detail">
          <h1 className="name">{this.state.product.name}</h1>
          <p className="description">{this.state.product.description}</p>
          <p className="price">Price: ${this.state.selectedProduct.price}</p>
          <select onChange={this.selectVariant}>
            {this.state.product.variants.map(function(variant, index){
              return (
                <option key={index} value={index}>{variant.type}</option>
              )
            })}
          </select>
          <button type="button" onClick={this.addToCart} disabled={ats  > 0 ? '' : 'disabled'}>
            {ats > 0 ? 'Add To Cart' : 'Sold Out'}
          </button>
        </div>
      </div>
    );
  },

  _onChange: function() {
    this.setState(getProductState());
  }

});

module.exports = FluxProduct;