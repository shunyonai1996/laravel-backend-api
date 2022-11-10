<template>
  <div>
      <p v-for="ceo in ceos">{{ ceo.name }} / {{ ceo.email }}</p>
      <p v-show="errorFlag">サーバとの通信にエラーが発生しています</p>
  </div> 
</template>

<script>
  export default {
    data() {
      return{
        ceos: [],
        errorFlag: false,
      }
    },
    mounted() {
      axios.get('api/ceo/1')
      .then(response => {
        this.ceos = response.data
        console.log(response.data)
        console.log(response.status)
        console.log(response.headers)
        console.log(response.statusText)
        console.log(response.config)
      })
      .catch(response => console.log(response))
    }
  }
</script>