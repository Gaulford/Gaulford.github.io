import Vue from 'vue'
import AppComponent from './app.component.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(AppComponent)
}).$mount('#app')
