<template>
  <div>
    <h1 class="recomend-h1">Recommendations for you</h1>
    <Film  :popularFilms="recomendations"/>
  </div>
</template>
<script>
import Film from '@/components/Film.vue'
export default {
  props: ['recomendations'],
  components: {
    Film
  }
}
</script>
<style lang="scss">
.recomend-h1{
  margin-left: 1.5%;
}
</style>