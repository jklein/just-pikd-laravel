module.exports = {
  // Load Mock Product Data Into localStorage
  init: function() {
    localStorage.clear();
    localStorage.setItem('product', JSON.stringify([
      {
        sku: '007-580572641-7',
        name: 'Stella(R) Freshly Shredded Parmesan 5 Oz Plastic Tub',
        link: '/products/007-580572641-7/Stella%28R%29+Freshly+Shredded+Parmesan+5+Oz+Plastic+Tub',
        image: 'https://s3.amazonaws.com/g2gcdn/23/00075805726417_200x200.jpg',
        list_cost: '$32.41',
        cat_name: 'Cheese',
        price: 32.41,
        inventory: 3
      }
    ]));
  }

};