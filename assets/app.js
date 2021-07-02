import './vendor'
import './filters'
import './helpers'
import './modules'
import './styles/app.scss'
import Vue from 'vue'
import store from './modules/store'
// start the Stimulus application
import './bootstrap'

var app = new Vue({
  data: {
  },
  el: "#app",
  mixins: [
  ],
  store: store,
  methods: {
  },
})
