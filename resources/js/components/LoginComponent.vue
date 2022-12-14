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
//author 米内
export default {
    data() {
        return {
            user: "",
            show: false,
        };
    },
    methods: {
        /**
         * ログイン処理
         * 
         * @param {string} user
         * @param {string} password
         */
        doLogin: function () {
            this.show = true;
            axios
                .post("api/login", {
                    email: this.user.email,
                    password: this.user.password,
                })
                .then(function (response) {
                    console.log(response);
                    console.log(response.data.access_token);
                    sessionStorage.setItem(
                        "access_token",
                        response.data.access_token
                    );
                    location.href = "/notification";
                })
                .catch(function (error) {
                    console.log(error);
                });
            this.$router.push(this.$route.query.redirect);
        },
    },
};
</script>
