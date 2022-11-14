<template>
  <div>
    <loading-component v-if="show"></loading-component>
    <ul v-for="ceo in ceos">
      <li>CEO名：{{ ceo.name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data () {
    return {
      ceos: [],
      show: true,
    }
  },
  mounted() {
    axios.get('/api/ceo')
    .then(response => {
      this.ceos = response.data.ceos;
      console.log(response.data)
    })
    .catch(response => console.log(response));
    this.show = false;
  }
}
</script>