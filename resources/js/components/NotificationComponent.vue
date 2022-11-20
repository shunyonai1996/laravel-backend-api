<template>
<div v-if="view">
  <button v-on:click="show" class="button">モーダルを表示</button>
  <modal name="hello-world" :draggable="true" :resizable="true" v-show="notification">
    <div class="modal-header">
      <h2>{{ notification.title }}</h2>
    </div>
    <div class="modal-body">
      <p>{{ notification.discription }}</p>
      <p>掲載期間：{{ notification.created_at }} 〜 {{ notification.end_date }}</p>
      <input type="checkbox">{{ notification.toggle_view = 1 ? '次回から表示しない' : '' }}
      <img :src="imgSrc">
      <button v-on:click="hide">閉じる</button>
    </div>
  </modal>
</div>
</template>

<script>
export default {
  data: function() {
    return {
      message: "お知らせ機能のテスト",
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
    axios.get('/api/notification/5')
    .then(response => {
      this.notification = response.data.notification;
      console.log(this.notification)
    })
    .catch(response => console.log(response));
  },
  computed: {
    imgSrc () {
      return ("../../../public/" + this.notification.image)
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