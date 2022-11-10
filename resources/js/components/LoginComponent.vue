<template>
  <form v-on:submit.prevent="doLogin">
      <label>E-mail</label>
      <input type="text" placeholder="E-mail" v-model="user.email" />
      <label>Password</label>
      <input type="password placeholder=password" v-model="user.password" />
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
      this.$store.dispatch("api/login", {
        userId: this.user.email,
        userPassword: this.user.password,
      });
      this.$router.push(this.$route.query.redirect);
    }
  }
};
</script>