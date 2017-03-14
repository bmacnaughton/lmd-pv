<template>
  <nav class="navs">
    <ul class="nav">
      <!-- -->
      <router-link
        class="nav__item nav__link"
        tag="li"
        active-class="-active"
        :href="nav.httpUrl"
        :to="nav.url"
        :key="nav.name"
        v-for="nav in navs">
        <!--<a class="nav__link" :href="nav.httpUrl">{{ nav.name }}</a>-->
        {{ nav.name }}
      </router-link>
        <!--
        <router-link class="nav__item nav__link" tag="li" active-class="-active" to="/manage">NO-Manage</router-link>
         -->
        <router-link class="nav__item nav__link" tag="li" active-class="-active" :to="{ name: 'user-register' }">Register</router-link>
        <li class="nav__item"><a class="nav__item nav__link" href='http://pv/processwire'>pw</a></li>
    </ul>
  </nav>
</template>

<script>
  import { mapGetters } from 'vuex'
  // import PwManage from '@/components/PwManage'

  export default {
    name: 'PwNav',
    // data: () => { return { manage: PwManage } },
    computed: {
      ...mapGetters([
        'navData'
      ]),
      navs() {
        if (!(this.navData.length)) return
        // remove home page from array
        return this.navData.slice(1, this.navData.length)
      }
    }
  }
</script>
