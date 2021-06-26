import Vue from 'vue'

export default {
  install (Vue, options) {
    Vue.mixin({
      data() {
        return {
          'themeSelected': null
        }
      },
      mounted() {
        if (this.$refs.themeSel) {
          this.themeSelected = this.$refs.themeSel.$attrs['data-value']
        }
      },
      methods: {
        themeChange(value) {
          this.$root.$refs.themeChangeForm.submit()
        }
      }
    })
  }
}

