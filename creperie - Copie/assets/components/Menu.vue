<template>
  <div class="album py-5 bg-dark">
    <div class="container">
      <div class="row" >
        <div class="col-md-4" v-for="c in crepes">
          <crepe-card :crepe="c"></crepe-card>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import CrepeCard from './CrepeCard'
export default {
  name:'Menu',
  components:{
    CrepeCard
  },
  data: () => ({
    crepes: localStorage.getItem("crepes")?JSON.parse(localStorage.crepes):[],
    url:window.location.protocol + '//' + window.location.host + '/api',
  }),
  methods: {

  },
  created() {
    /**
     * Appel de l'api pour récupérer chaque crépes
     */
    axios.get(this.url+ '/crepes',{
      headers:{
        'Accept': 'application/json'
      }}
    ).then(response => {
      this.crepes=response.data
      localStorage.crepes = JSON.stringify(response.data)
    })

  }
}
</script>