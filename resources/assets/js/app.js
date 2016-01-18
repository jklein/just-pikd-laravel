window.React = require('react');
var CartAPI = require('./utils/CartAPI')

var FluxProduct = require('./components/FluxProduct.react');
var FluxCart = require('./components/FluxCart.react');

// Load Mock API Call
CartAPI.getProductData(products);

React.render(
  <FluxCart />,
  document.getElementById('cart')
)

for (var key in products) {
    if (products.hasOwnProperty(key)) {
        React.render(
            <FluxProduct sku={ key } />,
            document.getElementById(key)
        )
    }
}


