<template>
  <div class="col s12">
    <div class="row">
      <Film  :popularFilms="popularFilms"/>
      <paginate
        :pageCount="totalPages"
        :clickHandler="clickPageHandler"
        :prevText="'Prev'"
        :nextText="'Next'"
        :containerClass="'pagination'"
        :page-class="'waves-effect'"
        :prev-link-class="'prev'"
        :next-link-class="'next'"
      >
      </paginate>
    </div>
  </div>
</template>
<script>
import Film from '@/components/Film.vue'
export default {
  data(){
    return {
      popularFilms: [],
      currentPage: 1,
      totalPages: 0,
      fetching: false
    }
  },
  components: {
    Film
  },
  created(){
    this.fetchData(this.currentPage)
  },
  methods: {
    clickPageHandler(page){
      this.fetchData(page)
    },
    fetchData(page){
      this.fetching = true
      fetch(`https://api.themoviedb.org/3/discover/movie?api_key=669d638558d729eee53e6894cba93512&sort_by=popularity.desc&include_adult=false&include_video=false&page=${page}`)
      .then(res => res.json())
      .then(data => {
        this.fetching = false
        this.popularFilms.length = 0
        data.results.forEach(i => this.popularFilms.push(i))
        this.currentPage = data.page
        this.totalPages = data.total_pages
      })
      .catch(e => console.log(e))
    }
  }
}
</script>
<style lang="scss" >
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  height: auto;
  li {
    height: auto;
  }
}

.prev,.next {
  border: 1px solid black;
  border-radius: 5px;
  padding: 5px 20px !important;
  margin: 0px 10px;
  outline: none;
}
</style>