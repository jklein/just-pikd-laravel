window.React = require('react');
var ProductData = require('./ProductData');
var CartAPI = require('./utils/CartAPI')

var FluxProduct = require('./components/FluxProduct.react');
var FluxCart = require('./components/FluxCart.react');


// Load Mock Product Data into localStorage
ProductData.init();

// Load Mock API Call
CartAPI.getProductData();

React.render(
  <FluxCart />,
  document.getElementById('cart')
)


React.render(
  <FluxProduct />,
  document.getElementById('products')
)