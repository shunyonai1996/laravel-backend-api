<template>
  <div class="style1">
    <h1>{{ message }}</h1>
    <p v-for="user in users">{{ user.name }} / {{ user.email }}</p>
    <p v-show="errorFlag">サーバとの通信にエラーが発生しています</p>
  </div> 
</template>

<script>
export default {
  data() {
    return {
        message: 'Hello Axios',
        users: [],
        errorFlag: false,
    };
  },
  mounted() {
    axios.get('/api/user')
    .then(response => {
      this.users = response.data.users
      console.log(this.users);    
    })
    .catch(response => console.log(response));
  },
}
</script>