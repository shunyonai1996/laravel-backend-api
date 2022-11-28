<template>
<div>
  <button v-on:click="show" class="button">モーダルを表示</button>
  <modal name='modal-window' :draggable="true" :resizable="true" v-for="notification in notifications">
    <div class="modal-header">
      <img :src="imgSrc">
    </div>
    <div class="modal-body">
      <p>掲載期間：{{ notification.start_date }} 〜 {{ notification.end_date }}</p>
      <input type="checkbox">{{ notification.hide_next_time == 0  ? '次回から表示しない' : '' }}
      <button v-on:click="hide">閉じる</button>
    </div>
  </modal>
</div>
</template>

<script>
export default {
  data: function() {
    return {
      notifications: [],
      errorFlag: false,
    }
  },
  methods: {
    show : function() {
      this.$modal.show('modal-window');
      console.log(this.$modal.show);
    },
    hide : function () {
      this.$modal.hide('modal-window');
      console.log(this.$modal.hide);
    },
  },
  mounted() {
    axios.get('/api/notification/')
    .then(response => {
      this.notifications = response.data.notifications;
      console.log(this.notifications)
    })
    .catch(response => console.log(response));
  },
  computed: {
    imgSrc: function() {
      for(let i=0; i<3; i++){
        const img = `/uploads/${this.notifications[i].image}`;
        console.log(img);
        return img;
      }
        
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
