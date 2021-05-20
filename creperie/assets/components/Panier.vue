<template>
  <div class="bg-light">
  <p>salut</p>
    <p>salut</p>
    <p>salut</p>
    <p>salut</p>
    <p>salut</p>
    <p>salut</p>
    <p>salut</p>

  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "Panier",
  data: () => ({
    url:window.location.protocol + '//' + window.location.host,
  }),
  created() {
    axios.get(this.url+ '/account',{
      headers:{
        'Accept': 'application/json'
      }}
    ).then(response => {
      console.log(response.data);

    })
  }
}
</script>