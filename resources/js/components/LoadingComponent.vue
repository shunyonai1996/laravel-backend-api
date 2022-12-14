<template>
    <img src="../../../image/loading.gif" v-if="show" />
</template>

<script>
// author 米内
export default {
    data: function () {
        return {
            show: false,
        };
    },
};
</script>
