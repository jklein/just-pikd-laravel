var React = require('react');
var FluxCartActions = require('../actions/FluxCartActions');
var CartStore = require('../stores/CartStore');
var ProductStore = require('../stores/ProductStore');


function getProductState(sku) {
  return {
    product: ProductStore.getProduct(sku),
    cartItems: CartStore.getCartItems(),
  };
}


// Flux product view
var FluxProduct = React.createClass({

  getInitialState: function() {
    return getProductState(this.props.sku);
  },

  // Add item to cart via Actions
  addToCart: function(event){
    var sku = this.state.product.pr_sku;
    var update = {
      name: this.state.product.pr_name,
      image_url: this.state.product.image_url,
      price: this.state.product.list_cost_cents
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
    var ats = (this.state.product.pr_sku in this.state.cartItems) ?
      this.state.product.inventory - this.state.cartItems[this.state.product.pr_sku].quantity :
      this.state.product.inventory;

    return (
      <div className="col-xs-6 col-sm-3 product_card">
        <div className="products__single">
          <figure className="products__image">
              <a href={this.state.product.link}>
                  <img alt={this.state.product.pr_name} className="product__image" width="200" height="200" src={this.state.product.image_url} />
              </a>
          </figure>
          <div className="row">
              <div className="col-xs-9">
                  <h5 className="products__title">
                      <a className="products__link js--isotope-title" href={this.state.product.link}>{this.state.product.pr_name}</a>
                  </h5>
              </div>
              <div className="col-xs-3">
                  <div className="products__price">
                      {this.state.product.list_cost_fmt}
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
    this.setState(getProductState(this.props.sku));
  }

});

module.exports = FluxProduct;