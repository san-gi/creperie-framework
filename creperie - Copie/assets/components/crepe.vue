<template>
  <v-app>
    <div class=" h-100 w-100 top-0 position-absolute">
      <div  v-if="crepe" class="album py-5 h-100" style="background-color: #95a5a6">
        <div class="container" >
          <p>{{this.crepe.name}}</p>
          <v-card
              elevation="24"
              outlined
              shaped
              color="blue-grey darken-1"
              dark><v-img
              class="white--text align-end"
              height="300px"
              :src="'./img/'+crepe.img+'.jpg'">
          </v-img>
            <v-card-text class="text--primary">
              <template v-slot:progress>
                <v-progress-linear
                    absolute
                    color="green lighten-3"
                    height="4"
                    indeterminate
                ></v-progress-linear>
              </template>
              <v-row>
                  <v-col class="text-center">
                    <h3 class="headline">
                      {{ this.crepe.name }}
                    </h3>
                    <span class="grey--text text--lighten-1">{{ this.crepe.desc }}</span>
                  </v-col>
              </v-row>
              <v-chip-group active-class="deep-purple accent-4 white--text" column>
                <v-chip
                    v-for="(i,index) in this.crepe.ingredients" :key="index"
                    color="green">
                  {{i.name}}
                </v-chip>
              </v-chip-group>
            </v-card-text>
            <v-form>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-autocomplete
                        v-model="extra"
                        :disabled="isUpdating"
                        :items="extraSelect"
                        filled
                        chips
                        color="dark"
                        label="un petit extra ?"
                        item-text="name"
                        item-value="name"
                        multiple>
                      <template v-slot:selection="data">
                        <v-chip
                            v-bind="data.attrs"
                            :input-value="data.selected"
                            close
                            @click="data.select"
                            @click:close="remove(data.item)">
                          <v-avatar left>
                            <v-img :src="data.item.avatar"></v-img>
                          </v-avatar>
                          {{ data.item.name }}
                        </v-chip>
                      </template>
                      <template v-slot:item="data">
                        <template v-if="typeof data.item !== 'object'">
                          <v-list-item-content v-text="data.item"></v-list-item-content>
                        </template>
                        <template v-else>
                          <!-- Si jamais j'ajoute une image pour les ingrédients, why not
                          <v-list-item-avatar>
                            <img :src="data.item.avatar">u
                          </v-list-item-avatar>
                          -->
                          <v-list-item-content>
                            <v-list-item-title v-html="data.item.name"></v-list-item-title>
                            <v-list-item-subtitle v-html="data.item.group"></v-list-item-subtitle>
                          </v-list-item-content>
                        </template>
                      </template>
                    </v-autocomplete>
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn :to="{name: 'menu'}"
                     color="black"
                     text>
                Retour au menu
              </v-btn>
              <v-btn :to="{name: 'panier',params:{crepe:this.crepe,extra:this.extra}}"
                  color="black"
                  text>
                Ajouter au panier
              </v-btn>
              <v-btn :to="{name: 'panier'}"
                     color="black"
                  text>
                Aller au panier
              </v-btn>
            </v-card-actions>
          </v-card>
        </div>
      </div>
    </div>
  </v-app>
</template>

<script>
import axios from "axios";

export default {
  name:"Crepe",

  data(){
    return {
      crepe:Object,
      ingredients: localStorage.getItem("ingredients")?JSON.parse(localStorage.crepes):[],
      extra: [],
      extraSelect:[],
      url:window.location.protocol + '//' + window.location.host + '/api',
      autoUpdate: true,
      friends: [],
      isUpdating: false,
      name: 'Midnight Crew',
    }
  },
  watch: {
    isUpdating (val) {
      if (val) {
        setTimeout(() => (this.isUpdating = false), 3000)
      }
    },
  },

  methods: {
    remove (item) {
      const index = this.extra.indexOf(item.name)
      if (index >= 0) this.extra.splice(index, 1)
    },
  },
  mounted() {
    this.crepe= this.$route.params.crepe
    axios.get(this.url+ '/ingredients',{
      headers:{
        'Accept': 'application/json'
      }}
    ).then(response => {
      this.ingredients=response.data
      localStorage.ingredients = JSON.stringify(response.data)

      this.extraSelect.push({ header: 'Ingredients' },)
      this.ingredients.forEach(ingredient =>{
        console.log(this.crepe.ingredients.filter(item=>item.name===ingredient.name)==0)
        if(this.crepe.ingredients.filter(item=>item.name===ingredient.name)==0)
        this.extraSelect.push({ name: ingredient.name, group: ingredient.price+" €" },)
      })
      console.log(this.extraSelect)
    })
  }
}
</script>
