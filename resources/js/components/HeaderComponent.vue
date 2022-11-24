<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">Vue Laravel SPA</span>
                <button type="button" class="btn btn-danger" @click="doLogout">Logout</button>
                <router-link to='/home'>ユーザ一覧</router-link>
                <router-link to='/login'>ログイン</router-link>
                <router-link to='/ceo'>会社一覧</router-link>
                <router-link to='/post'>登録</router-link>
            </nav>
        </div>
    </div>
</template>

 
<script>
export default {
    methods: {
    doLogout() {
        axios.get('api/logout')
    .then(response => {
        sessionStorage.removeItem("access_token");
        delete axios.defaults.headers['Authorization'];
        location.href = '/login'
    }).catch(error=> {
        console.log(error);
    });
    this.$router.push(this.$route.query.redirect);
    }
    
  }
}
</script>