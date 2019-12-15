import '@babel/polyfill'
import './vendor'
import './filters'
import './modules'
import '../scss/app.scss'
import Vue from 'vue'
import store from './modules/store'

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
