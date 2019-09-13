<template>
  <div class="film-dashboard">
    <div v-for="film in popularFilms" :key="film.id" class="card film-card" >
      <router-link :to="`/movie/${film.id}`" class="thumbnail">
        <div class="card-image">
          <img :src="`https://image.tmdb.org/t/p/w342${film.poster_path}`">
        </div>
        <div class="movie-description">
          <h2>{{film.title}}</h2>
          <section class="movie-details">
            <div class="movie-year">
              <span class="title">Year</span>
              <span>{{film.release_date.substring(0, 4)}}</span>
            </div>
            <div class="movie-rating">
              <span class="title">Rating</span>
              <span>{{film.vote_average}}</span>
            </div>
          </section>
        </div>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  props: ['popularFilms']
}
</script>
<style lang="scss" scoped>
.film-dashboard {
  flex-basis: 80%;
	display: flex;
	flex-wrap: wrap;
	padding: 0 0;
	margin: 0;
}
.film-card {
  flex-basis: 17%;
  box-sizing: border-box;
  margin: 1.5%;
  display: flex;
  flex-direction: column;
  box-shadow: 0 10px 28px -7px rgba(0,0,0,0.1);
}
.film-card img {
	width: 100%;
  height: auto;
}

.movie-description {
	display: flex;
	flex-direction: column;
	flex-grow: 1;
	justify-content: space-between;
	padding: 10px;
}
.movie-description h2{
	color: #555;
	font-weight: bold;
  margin-top: 10px;
	margin-bottom: 20px;
  font-size: 1.5em;
}
.movie-details{
	display: flex;
	justify-content: space-between;
}

.movie-details span{
	color: #555;
	font-weight: bold;
}
.movie-year, .movie-rating{
	display: flex;
	flex-direction: column;
}
.movie-year .title, .movie-rating .title {
	color: #aaa;
	margin-bottom: 5px;
	font-weight: normal;
}
.movie-rating{
	align-items: flex-end;
}
.thumbnail {
  display: flex;
  flex-grow: 1;
  flex-direction: column;
}
</style>