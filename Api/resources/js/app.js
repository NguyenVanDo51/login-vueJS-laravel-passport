require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('test', require('./components/test.vue').default);

// const app = new Vue({
//     el: '#app',
// });
