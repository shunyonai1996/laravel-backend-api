<template>
<div v-if="view">
  <button v-on:click="show" class="button">モーダルを表示</button>
  <modal name="hello-world" :draggable="true" :resizable="true" v-show="notification">
    <div class="modal-header">
      <img :src="imgSrc">
    </div>
    <div class="modal-body">
      <p>掲載期間：{{ notification[0].start_date }} 〜 {{ notification[0].end_date }}</p>
      <input type="checkbox">{{ notification[0].hide_next_time == 0  ? '次回から表示しない' : '' }}
      <button v-on:click="hide">閉じる</button>
    </div>
  </modal>
</div>
</template>

<script>
export default {
  data: function() {
    return {
      notification: [],
      errorFlag: false,
      view: true
    }
  },
  methods: {
    show : function() {
      this.$modal.show('hello-world');
      console.log(this.$modal.show);
    },
    hide : function () {
      this.$modal.hide('hello-world');
      console.log(this.$modal.hide);
    },
  },
  mounted() {
    axios.get('/api/notification/')
    .then(response => {
      this.notification = response.data.notifications;
      console.log(this.notification)
    })
    .catch(response => console.log(response));
  },
  computed: {
    imgSrc () {
      const img = `"../../../public/uploads/"${this.notification[0].image}`;
      return img
    }
  }
}
</script>

<style>
.style1 {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 120px;
}
</style>