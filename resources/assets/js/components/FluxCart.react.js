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
            {Object.keys(products).map(function(product){
              return (
                <div className="header-cart__product clearfix js--cart-remove-target">
                  <div className="header-cart__product-image">
                    <img alt="Product in the cart" src={products[product].image_url} width="40" height="40" />
                  </div>
                  <div className="header-cart__product-image--hover">
                    <a href="#" className="js--remove-item" data-target=".js--cart-remove-target" onClick={self.removeFromCart.bind(self, product)}>
                      <span className="glyphicon  glyphicon-circle  glyphicon-remove"></span>
                    </a>
                  </div>
                  <div className="header-cart__product-title">
                    <a className="header-cart__link" href="single-product.html">{products[product].name}</a>
                    <span className="header-cart__qty">Qty: {products[product].quantity}</span>
                  </div>
                  <div className="header-cart__price">
                    ${((products[product].price/100) * products[product].quantity).toFixed(2)}
                  </div>
                </div>
              )
            })}
            <hr class="header-cart__divider" />
            <div class="header-cart__subtotal-box">
              <span class="header-cart__subtotal">CART SUBTOTAL:</span>
              <span class="header-cart__subtotal-price">${this.props.total}</span>
            </div>
            <a class="btn btn-darker" href="/cart">Procced to checkout</a>
      </div>
    );
  },





  // Method to setState based upon Store changes
  _onChange: function() {
    this.setState(getCartState());
  }

});

module.exports = FluxCart;