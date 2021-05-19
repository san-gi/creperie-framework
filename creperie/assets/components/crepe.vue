<template>
  <div class=" h-100 w-100 top-0 position-absolute">
      <div  v-if="crepe" class="album py-5 h-100" style="background-color: #95a5a6">
        <div class="container" >
          <p>{{this.crepe.name}}</p>

        <v-card
            elevation="24"
            outlined
            shaped
            style="background-color: #ecf0f1"
        ><v-img
            class="white--text align-end"
            height="200px"
            :src="'./img/'+crepe.img+'.jpg'"
        >

        </v-img>

          <v-card-subtitle class="pb-0">
            {{ this.crepe.name }}
          </v-card-subtitle>

          <v-card-text class="text--primary">
            <div>blalabla</div>


          </v-card-text>

          <v-card-actions>
            <v-btn :to="{name: 'menu'}"
                color="orange"
                text
            >
              Retour au menu
            </v-btn>

            <v-btn
                color="orange"
                text
            >
              Aller au panier
            </v-btn>
          </v-card-actions>
        </v-card>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name:"Crepe",

  data(){
    return {
      crepe:Object
    }
  },
  mounted() {
    console.log("oui")
    this.crepe= this.$route.params.crepe

  }
}
</script>
