var React = require('react');

var exampleComponent = React.createFactory(require('./example_component.jsx'));

React.render(
  exampleComponent(),
  document.getElementById('example')
);