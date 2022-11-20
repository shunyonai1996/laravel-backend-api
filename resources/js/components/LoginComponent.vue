<template>
  <form v-on:submit.prevent="doLogin">
      <label>E-mail</label>
      <input type="text" placeholder="E-mail" v-model="user.email" />
      <label>Password</label>
      <input type="password" placeholder="password" v-model="user.password" />
      <button type="submit">Login</button>
      <loading-component v-if="show"></loading-component>
  </form>
</template>

<script>
export default {
  data() {
    return {
      user: {},
      show:false
    };
  },
  methods: {
    doLogin() {
      this.show = true;
      axios.post('api/login', {
        email: this.user.email,
        password: this.user.password,
         })
         .then(function(response) {
              console.log(response);
              console.log(response.data.access_token);
              sessionStorage.setItem("access_token", response.data.access_token);
              location.href = '/ceo';
         }).catch(function(error) {
              console.log(error);
         });
         this.$router.push(this.$route.query.redirect);
    }
  }
}
</script>