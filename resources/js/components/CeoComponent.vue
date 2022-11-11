<template>
  <div>
    <ul v-for="ceo in ceos">
      <li>CEO名：{{ ceo.name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data () {
    return {
      ceos: []
    }
  },
  mounted() {  
    axios.get('/api/ceo')
    .then(response => {
      this.ceos = response.data.ceos
      console.log(response.data)
      console.log(this.ceos)
    })
    .catch(response => console.log(response));
    
  }
}
</script>