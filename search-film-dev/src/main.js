import Vue from 'vue'
import App from './App.vue'
import Paginate from 'vuejs-paginate'
import Autocomplete from '@trevoreyre/autocomplete-vue'
import router from './router'
import 'materialize-css/dist/js/materialize.min'


Vue.config.productionTip = false
Vue.component('paginate', Paginate)
Vue.component('Autocomplete', Autocomplete)

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
