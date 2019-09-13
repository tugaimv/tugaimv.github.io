<template>
  <nav class="grey darken-3">
    <div class="nav-wrapper">
      <router-link to='/' class="brand-logo">filmSearch</router-link>
      <div class="search-wrapper">
        <Autocomplete 
          :search="search" 
          placeholder="Search films"
          aria-label="Search films" 
          :get-result-value="getResultValue"
          @submit="handleSubmit"
          />
      </div> 
    </div>
  </nav>
</template>
<script>
export default {
  methods: {
    search(input){
      const url = `https://api.themoviedb.org/3/search/movie?api_key=669d638558d729eee53e6894cba93512&language=en-US&query=${encodeURI(input)}&page=1&include_adult=false`
      return new Promise(resolve => {
        if (input.length < 1) {
          return resolve([])
        } 

        fetch(url)
          .then(res => res.json())
          .then(data => {
            resolve(data.results)
          })
      })
    },
    getResultValue(result){
      return result.title
    },
    handleSubmit(result) {
      this.$router.push('/movie/' + result.id)
      
    }
  }
}
</script>
<style lang="scss" >

</style>