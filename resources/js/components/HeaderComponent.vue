<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">OJT-APP</span>
                <router-link to='/home'>ユーザ一覧</router-link>
                <router-link to='/ceo'>会社一覧</router-link>
                <router-link to='/post'>登録</router-link>
                <router-link to='/login' v-if="login == null">ログイン</router-link>
                <a href="/login" @click="doLogout" v-if="login != null">ログアウト</a>
            </nav>
        </div>
    </div>
</template>

 
<script>
// author 米内
export default {
    data() {
        return {
            login: sessionStorage.getItem("access_token"),
        };
    },
    methods: {
        /**
         * ログアウト
         */
        doLogout() {
        try {
            sessionStorage.removeItem("access_token");
            delete axios.defaults.headers['Authorization'];
            router.push('login');
        } catch (error) {
            console.log(error);
        };
        }
    }

}
</script>