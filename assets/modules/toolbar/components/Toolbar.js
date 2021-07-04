export default {
  template: `
    <div>
    <nav class="navbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">#</a>
        </li>
      </ul>
    </nav>
    <b-navbar toggleable="md" type="dark" variant="dark" class="main-menu" fixed="top">
      <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
      <b-collapse is-nav id="nav_collapse">
        <b-navbar-nav v-for="(nav, idx) in menu" :key="idx" :class="[
            'toolbar-nav', nav.nav_class
            ]">
          <div v-for="(item, index) in nav.submenu" :key="index" :class="[
              item.item_class || 'toolbar-item'
              ]">
            <template v-if="item.vue_component">
              <component :is="item.vue_component" v-bind="item.vue_prop" :menu-item="item"></component>
            </template>
            <template v-else-if="item.submenu">
              <b-nav-item-dropdown right>
                <template slot="button-content">
                  <template v-if="item.icon"><i :class="item.icon"></i>&nbsp;</template>
                  <span class="menu-text">{{ item.name }}</span>
                </template>
                <div v-for="(subitem, subindex) in item.submenu" :key="subindex">
                  <b-dropdown-item :href="subitem.link" :active="subitem.active">
                    <template v-if="subitem.icon"><i :class="subitem.icon"></i>&nbsp;</template>
                    {{ subitem.name }}
                  </b-dropdown-item>
                </div>
              </b-nav-item-dropdown>
            </template>
            <template v-else>
              <b-nav-item :href="item.link" :active="item.active">
                <template v-if="item.icon"><i :class="item.icon"></i>&nbsp;</template>
                <span class="menu-text">{{ item.name }}</span>
              </b-nav-item>
            </template>
          </div>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    </div>
  `,
  props: {
    menu: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
    }
  },
  mounted() {
    //console.log(this.menu)
  },
}
