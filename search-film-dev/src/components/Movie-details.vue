<template>
  <div v-if="loading">
    <div class="progress" >
      <div class="indeterminate"></div>
    </div>
  </div>
  <div class='movie-page' v-else>
    <div>
      <div v-if="background.length" class="movie-image" :style="{ backgroundImage: 'url(' + background + ')' }" />
      <div class="movie-details">
        <h1>
          {{movie.original_title}}
          <span>{{movie.release_date.substring(0, 4)}}</span>
        </h1>	
							<section class="genres">
									<div v-for="(genre, idx) in movie.genres" :key='idx'>
										<span>{{genre.name}}</span>
											<span class="separator">|</span>
									</div>
							</section>
							<h5>
								Rating:
								<span>{{movie.vote_average}}</span>
							</h5>
							<h5>
								Runtime:
								<span>{{movie.runtime}} min</span>
							</h5>
							<h4>Overview</h4>
							<p>{{movie.overview}}</p>		
						</div>
					</div>
						<div v-if="loadingRecomen">
							<div class="progress" >
        				<div class="indeterminate"></div>
      				</div>
						</div>
						<div v-else-if="!recomendations.length" class="recomend-dont-find"><h3>We dont have recommendations  for you, sorry!</h3></div>
						<Recomendation v-else :recomendations="recomendations"  />
			</div>     
</template>
<script>
import Recomendation from '@/components/Recomendation.vue'
export default {
	components : {
		Recomendation
	},
  data(){
    return {
			loading: false,
			loadingRecomen: false,
      movie: {},
			background: '',
			recomendations: []
    }
  },
  created(){
		this.fetchAll()
	},
	watch: {
		'$route': 'fetchAll'
	},
  methods: {
		fetchAll(){
			this.fetchMovie()
			this.fetchRecomendations()
		},
    fetchMovie(){
      this.loading = true
      const id = this.$route.params.id 
      const Url = `https://api.themoviedb.org/3/movie/${id}?api_key=669d638558d729eee53e6894cba93512&language=en-US`
			fetch(Url)
				.then(res => res.json())
        .then(data => {
          this.movie = data
					this.loading = false
					if(data.backdrop_path || data.poster_path) {
						this.background = `https://image.tmdb.org/t/p/w1280${data.backdrop_path || data.poster_path}`
					} else {
						this.background = ''
					}
        })
        .catch(err => console.log(e)) 
		},
		fetchRecomendations(){
			this.loadingRecomen = true
			const id = this.$route.params.id 
			const url = `https://api.themoviedb.org/3/movie/${id}/recommendations?api_key=669d638558d729eee53e6894cba93512&language=en-US&page=1`
			fetch(url).then(resp => resp.json())
				.then(data => {
					this.recomendations.length = 0
					if(data.results) {
						data.results.forEach(i => this.recomendations.push(i))
					}
					this.loadingRecomen = false
				})
				.catch(err => console.log(err))
		}
  }
}
</script>

<style lang="scss" scoped>
.movie-image {
	flex-basis: 100%;
	height: 575px;
	-webkit-background-size: cover;
	background-size: cover;
	background-position: top center;
}
.movie-page{
	display: flex;
	flex-direction: column;
}

.movie-page h5{
	color: #888;
	font-weight: normal;
	line-height: 1.25rem;
}

.movie-page h5 span {
	font-size: inherit;
	font-weight: normal;
	color: black;
	padding-left: 1rem;
}

.movie-page h4 {
	margin: 0;
	font-size: 1.25rem;
	line-height: 2;
}

.movie-page p {
	color: #888;
	line-height: 1.5;
}

.movie-page .movie-image {
	flex-basis: 100%;
	height: 575px;
	-webkit-background-size: cover;
	background-size: cover;
	background-position: top center;
}

.movie-page .movie-details{
	display: flex;
	flex-direction: column;
	max-width: 800px;
	margin: 20px auto 60px auto;
}

.movie-page .movie-details h1 {
	line-height: 1.5em;
}

.movie-page .movie-details h1 span {
	font-size: inherit;
	font-weight: normal;
	padding-left: 1rem;
	color: #bbb;
	line-height: inherit;
}

.movie-page .genres{
	display: flex;
	margin-bottom: 1rem;
}
.movie-page .genres span {
	font-weight: normal;
}

.movie-page .separator{
	color: lightgray;
	padding: 0 10px;
}
</style>