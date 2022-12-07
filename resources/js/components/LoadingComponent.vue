<template>
      <img src="../../../image/loading.gif" v-if="show">
</template>

<script>
export default{
  data: function() {
    return {
      show: false,
    }
  },
}
</script>