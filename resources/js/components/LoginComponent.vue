<template>
  <form v-on:submit.prevent="doLogin">
      <label>E-mail</label>
      <input type="text" placeholder="E-mail" v-model="user.email" />
      <label>Password</label>
      <input type="password" placeholder="password" v-model="user.password" />
      <button type="submit">Login</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      user: {}
    };
  },
  methods: {
    doLogin() {
      axios.post('api/login', {
        email: this.user.email,
        password: this.user.password,
         })
         .then(function(response) {
              console.log(response);
              console.log(response.data.access_token);
              sessionStorage.setItem("access_token", response.data.access_token);
              location.href = '/post';
         }).catch(function(error) {
              console.log(error);
         });
         this.$router.push(this.$route.query.redirect);
    }
  }
}
</script>