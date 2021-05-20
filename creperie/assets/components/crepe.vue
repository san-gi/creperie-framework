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
              dark
          ><v-img
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
            </v-card-text>
            <v-form>
              <v-container>
                <v-row>
                  <v-col
                      cols="12"
                      md="6"
                  >
                    <v-text-field
                        v-model="name"
                        :disabled="isUpdating"
                        filled
                        color="blue-grey lighten-2"
                        label="Name"
                    ></v-text-field>
                  </v-col>
                  <v-col
                      cols="12"
                      md="6">
                    <v-text-field
                        v-model="title"
                        :disabled="isUpdating"
                        filled
                        color="blue-grey lighten-2"
                        label="Title"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-autocomplete
                        v-model="friends"
                        :disabled="isUpdating"
                        :items="people"
                        filled
                        chips
                        color="blue-grey lighten-2"
                        label="Select"
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
                          <v-list-item-avatar>
                            <img :src="data.item.avatar">u
                          </v-list-item-avatar>
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
              <v-switch
                  v-model="autoUpdate"
                  :disabled="isUpdating"
                  class="mt-0"
                  color="green lighten-2"
                  hide-details
                  label="Auto Update"></v-switch>
              <v-spacer></v-spacer>
              <v-btn
                  :disabled="autoUpdate"
                  :loading="isUpdating"
                  color="blue-grey darken-3"
                  depressed
                  @click="isUpdating = true">
                <v-icon left>
                  mdi-update
                </v-icon>
                Update Now
              </v-btn>
              <v-btn :to="{name: 'menu'}"
                     color="orange"
                     text>
                Retour au menu
              </v-btn>
              <v-btn :to="{name: 'panier'}"
                  color="orange"
                  text>
                Ajouter au panier
              </v-btn>
              <v-btn :to="{name: 'menu'}"
                     color="orange"
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
export default {
  name:"Crepe",

  data(){
    const srcs = {
      1: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
      2: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
      3: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
      4: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
      5: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
    }
    return {
      crepe:Object,
      Nb:Number,
      extra: [],
      autoUpdate: true,
      friends: ['Sandra Adams', 'Britta Holt'],
      isUpdating: false,
      name: 'Midnight Crew',
      people: [
        { header: 'Group 1' },
        { name: 'Sandra Adams', group: 'Group 1', avatar: srcs[1] },
        { name: 'Ali Connors', group: 'Group 1', avatar: srcs[2] },
        { name: 'Trevor Hansen', group: 'Group 1', avatar: srcs[3] },
        { name: 'Tucker Smith', group: 'Group 1', avatar: srcs[2] },
        { divider: true },
        { header: 'Group 2' },
        { name: 'Britta Holt', group: 'Group 2', avatar: srcs[4] },
        { name: 'Jane Smith ', group: 'Group 2', avatar: srcs[5] },
        { name: 'John Smith', group: 'Group 2', avatar: srcs[1] },
        { name: 'Sandra Williams', group: 'Group 2', avatar: srcs[3] },
      ],
      title: 'The summer breeze',

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
      const index = this.friends.indexOf(item.name)
      if (index >= 0) this.friends.splice(index, 1)
    },
  },
  mounted() {
    console.log("oui")
    this.crepe= this.$route.params.crepe
  }
}
</script>
