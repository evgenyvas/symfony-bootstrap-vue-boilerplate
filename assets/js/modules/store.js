import Vue from 'vue'
import Vuex from 'vuex'
import ajax from './ajax/store'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    ajax,
  }
})
