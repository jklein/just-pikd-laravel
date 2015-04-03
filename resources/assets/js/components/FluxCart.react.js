var React = require('react');
var FluxCartActions = require('../actions/FluxCartActions');
var CartStore = require('../stores/CartStore');

function getCartState() {
  return {
    cartItems: CartStore.getCartItems(),
    cartCount: CartStore.getCartCount(),
    cartTotal: CartStore.getCartTotal(),
    cartVisible: CartStore.getCartVisible()
  };
}


// Flux cart view
var FluxCart = React.createClass({

  getInitialState: function() {
    return getCartState();
  },

  // Hide cart via Actions
  closeCart: function(){
    FluxCartActions.updateCartVisible(false);
  },

  // Show cart via Actions
  openCart: function(){
    FluxCartActions.updateCartVisible(true);
  },

  // Remove item from Cart via Actions
  removeFromCart: function(sku){
    FluxCartActions.removeFromCart(sku);
    FluxCartActions.updateCartVisible(false);
  },

  // Add change listeners to stores
  componentDidMount: function() {
    CartStore.addChangeListener(this._onChange);
  },

  // Remove change listers from stores
  componentWillUnmount: function() {
    CartStore.removeChangeListener(this._onChange);
  },

  // Render cart view
  render: function() {
    var self = this, products = this.state.cartItems;
    return (
      <div className={"flux-cart " + (this.props.visible ? 'active' : '')}>
        <div className="mini-cart">
          <button type="button" className="close-cart" onClick={this.closeCart}>×</button>
          <ul>
            {Object.keys(products).map(function(product){
              return (
                <li key={product}>
                  <h1 className="name">{products[product].name}</h1>
                  <p className="type">{products[product].type} x {products[product].quantity}</p>
                  <p className="price">${(products[product].price * products[product].quantity).toFixed(2)}</p>
                  <button type="button" className="remove-item" onClick={self.removeFromCart.bind(self, product)}>Remove</button>
                </li>
              )
            })}
          </ul>
          <span className="total">Total: ${this.props.total}</span>
        </div>
        <button type="button" className="view-cart" onClick={this.openCart} disabled={Object.keys(this.state.cartItems).length > 0 ? "" : "disabled"}>View Cart ({this.props.count})</button>
      </div>
    );
  },

  // Method to setState based upon Store changes
  _onChange: function() {
    this.setState(getCartState());
  }

});

module.exports = FluxCart;