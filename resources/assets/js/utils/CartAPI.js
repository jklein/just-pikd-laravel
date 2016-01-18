var FluxCartActions = require('../actions/FluxCartActions');

module.exports = {

  // Load mock product data from localStorage into ProductStore via Action
  getProductData: function(product_data) {
    FluxCartActions.receiveProduct(product_data);
  }

};