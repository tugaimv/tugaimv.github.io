<template>
  <div id="app">
    <Header />
    <div class="row">
      <router-view/>
    </div>
  </div>
</template>

<script>
import Header from "@/components/Header.vue"

export default {
  components: {
    Header
  }
}  
</script>
<style lang="sass">
@import '~materialize-css/dist/css/materialize.min.css';
@import '~@trevoreyre/autocomplete-vue/dist/style.css'
@import './assets/style.scss';
</style>
