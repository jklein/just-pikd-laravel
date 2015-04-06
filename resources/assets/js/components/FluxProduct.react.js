var React = require('react');
var FluxCartActions = require('../actions/FluxCartActions');
var CartStore = require('../stores/CartStore');
var ProductStore = require('../stores/ProductStore');


function getProductState() {
  return {
    product: ProductStore.getProduct(),
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
    var sku = this.state.product.sku;
    var update = {
      name: this.state.product.name,
      price: this.state.product.price
    }
    FluxCartActions.addToCart(sku, update);
    FluxCartActions.updateCartVisible(true);
  },

  // Add change listeners to stores
  componentDidMount: function() {
    ProductStore.addChangeListener(this._onChange);
    CartStore.addChangeListener(this._onChange);
  },

  // Remove change listers from stores
  componentWillUnmount: function() {
    ProductStore.removeChangeListener(this._onChange);
  },

  // Render product View
  render: function() {
    var ats = (this.state.product.sku in this.state.cartItems) ?
      this.state.product.inventory - this.state.cartItems[this.state.product.sku].quantity :
      this.state.product.inventory;

    return (
      <div className="col-xs-6 col-sm-3 product_card">
        <div className="products__single">
          <figure className="products__image">
              <a href={this.state.product.link}>
                  <img alt={this.state.product.name} className="product__image" width="200" height="200" src={this.state.product.image} />
              </a>
          </figure>
          <div className="row">
              <div className="col-xs-9">
                  <h5 className="products__title">
                      <a className="products__link js--isotope-title" href={this.state.product.link}>{this.state.product.name}</a>
                  </h5>
              </div>
              <div className="col-xs-3">
                  <div className="products__price">
                      {this.state.product.list_cost}
                  </div>
              </div>
          </div>
          <div className="products__category">
              {this.state.product.cat_name}
          </div>


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