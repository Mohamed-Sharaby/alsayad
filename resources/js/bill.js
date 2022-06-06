import Vue from "vue";
import vSelect from "vue-select";

import 'vue-select/dist/vue-select.css';
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


Vue.config.productionTip = false;

Vue.directive("click-outside-app", {
  bind: function (el, binding) {
    // Define ourClickEventHandler
    const ourClickEventHandler = (event) => {

      if (
        !el.contains(event.target) &&
        el !== event.target &&
        !event.target.classList.contains("modal-opener")&&
        !event.target.classList.contains("inner")
      ) {
        // as we are attaching an click event listern to the document (below)
        // ensure the events target is outside the element or a child of it
        binding.value(event); // before binding it
      }
    };
    // attached the handler to the element so we can remove it later easily
    el.__vueClickEventHandler__ = ourClickEventHandler;

    // attaching ourClickEventHandler to a listener on the document here
    document.addEventListener("click", ourClickEventHandler);
  },
  unbind: function (el) {
    // Remove Event Listener
    document.removeEventListener("click", el.__vueClickEventHandler__);
  },
});
Vue.component("v-select", vSelect);
Vue.component('app',require('./components/App').default);
 new Vue({
    el:'#app',

});
