<template>
    <form v-on:submit.prevent="doLogin" class="container">
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="text" id="email" class="form-control" placeholder="E-mail" v-model="user.email" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" placeholder="password" v-model="user.password" />
        </div>
        <button type="submit">Login</button>
        <loading-component v-if="show"></loading-component>
    </form>
</template>

<script>
//author 米内
export default {
    data() {
        return {
            user: [],
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
            let self = this;
            this.show = true;
            axios
                .post("api/login", {
                    email: this.user.email,
                    password: this.user.password,
                })
                .then(function (response) {
                    sessionStorage.setItem(
                        "access_token",
                        response.data.access_token
                    );
                    location.href = "/notification";
                })
                .catch(function (error) {
                    console.log(error);
                });
            self.$router.push(this.$route.query.redirect);
        },
    },
};
</script>
