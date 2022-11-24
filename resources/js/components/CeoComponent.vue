<template>
  <div>
    <loading-component v-if="show"></loading-component>
    <notification-component></notification-component>
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
      console.log(this.ceos);
    })
    .catch(response => console.log(response));
    this.show = false;
    
    axios.get('/api/notification')
    .then(response => {
      this.notifications = response.data;
      console.log(this.notifications);
    })
    .catch(response => console.log(response));
    
  }
}
</script>