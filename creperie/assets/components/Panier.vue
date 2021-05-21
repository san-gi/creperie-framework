<template>
  <v-app>
    <div class="album py-5 bg-dark h-100 mt-6">
      <div class="container">
        <div class="row bg-light" >
          <div class="col-md-4" v-for="(c,index) in items" :key="index">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{c.crepe.name}}</h5>
                <p class="card-text">{{c.crepe.description}}</p>
                    <span v-for="i in c.crepe.ingredients" class="badge bg-secondary m-1">{{i.name+" "}} </span>
                    <span v-for="i in c.extra" class="badge bg-success m-1">{{ ingredients.filter(item =>item.name==i)[0].name}} </span>
                <p>Prix : {{ c.price}} €</p>
                <a class="btn btn-danger"  @click="retirer(c)" >Retirer</a>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="container bg-light">
        <v-btn color="black"  @click="valider()" text>
          Valider le panier
        </v-btn>
      </div>

    </div>
  </v-app>
</template>
<script>
import axios from "axios";

export default {
  name: "Panier",
  data: () => ({
    url:window.location.protocol + '//' + window.location.host,
    crepe:Object,
    extra:Object,
    items: [],
    loading: false,
    selection: 1,
    ingredients:[],
  }),

  mounted() {
    this.ingredients =JSON.parse(localStorage.getItem("ingredients")),
    this.crepe= this.$route.params.crepe
    this.extra= this.$route.params.extra
    if(localStorage.getItem("panier")){
      this.items = JSON.parse(localStorage.panier)
    }
    if(this.crepe!=null){
      let item = {crepe:this.crepe,extra:this.extra}
      item.price=this.ingredients.filter(i=>item.extra.includes(i.name)).map(i=>i.price).reduce((a,c)=>a+c,item.crepe.price)
      this.items.push(item)
    }
    localStorage.panier = JSON.stringify(this.items);
    axios.get(this.url+ '/account',{
      headers:{
        'Accept': 'application/json'
      }}
    ).then(response => {
    })
  },
  methods: {
    retirer(item){
      this.items = this.items.filter(i=>i!=item)
      localStorage.panier = JSON.stringify(this.items);
    },
    valider(){
      
    }
  },

}
</script>