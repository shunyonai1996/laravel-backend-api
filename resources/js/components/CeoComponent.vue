<template>
    <div class="style1">
        <loading-component v-if="show"></loading-component>
        <h1>CEO一覧</h1>
        <p v-for="ceo in ceos" style="list-style: none;">CEO名：{{ ceo.name }}</p>
    </div>
</template>

<script>
// author 米内
export default {
    data() {
        return {
            ceos: [],
            show: true,
        };
    },

    mounted() {
        axios
            .get("/api/ceo")
            .then((response) => {
                this.ceos = response.data.ceos;
            })
            .catch((response) => console.log(response));
        this.show = false;
    },
};
</script>
