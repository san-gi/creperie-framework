<template>
  <v-card :loading="loading" class="mx-auto my-12" max-width="374">
    <template slot="progress">
      <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
    </template>
    <v-img aspect-ratio="1.7" :src="'./img/'+crepe.img+'.jpg'"></v-img>
    <v-card-title>{{crepe.name}}</v-card-title>
    <v-card-text>
      <v-chip-group v-model="selection" active-class="deep-purple accent-4 white--text" column>
        <v-chip
            v-for="(i,index) in crepe.ingredients" :key="index"
            color="red"
        >
          {{i}}
        </v-chip>
      </v-chip-group>
    </v-card-text>
    <v-card-text>
      <!--
      <v-row align="center" class="mx-0">
        <v-rating :value="3" color="amber" dense half-increments readonly size="14"></v-rating>
        <div class="grey--text ml-4">
          3 (413)
        </div>
      </v-row>

      <div class="my-4 subtitle-1">
      </div>
      -->
      <div>{{crepe.description}}</div>
    </v-card-text>
    <v-divider class="mx-4"></v-divider>


    <v-card-actions>
      <v-btn :to="{name: 'crepe',params:{crepe:this.crepe,name:this.crepe.name}}"color="deep-purple lighten-2" text @click="reserve">
        Consulter
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script>
export default {
  name:"CrepeCard",
  props: {
    crepe: Object,
  },

  data(){
    return {
      loading: false,
      selection: 1,
    }
  },
  methods: {
    reserve() {this.loading = true
      setTimeout(() => (this.loading = false), 2000)
    },
  },
}
</script>
