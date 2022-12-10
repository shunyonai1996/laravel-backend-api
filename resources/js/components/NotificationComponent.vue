<template>
  <div>
    <img src="../../../image/loading.gif" v-show="load">

    <modal name='modal-window' v-for="(notify, index) in notifies.slice(a,b)" :key="index" :clickToClose="false" :reset="true" :trandition="false" :draggable="true" :resizable="true">
      <div class="modal-header">
        <img :src="`/uploads/${notify.image}`">
      </div>

      <div class="modal-body">

        <div v-if="notify.hide_next_time === 1">
          <span>次回から表示しない</span>
          <input type="checkbox" v-model="hide_next" value=true>
        </div>
        <div v-else-if="notify.already_read === 1">
          <span>読みました</span>
          <input type="checkbox" v-model="read">
        </div>
        <div v-else>
          <p>メンテナンス系</p>
        </div>

      <button @click="hidePopup(); nextPopup();">閉じる</button>

      </div>

    </modal>
  </div>
</template>

<!-- Script -->
<script>
export default {
  data () {
    return {
      notifies: [],
      user_id: '',
      hide_next: false,
      read: false,
      a: 0,
      b: 1,
      i: 0,
      load: false,
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
    hidePopup : async function () {
      if(this.read || this.hide_next) {
        this.load = true;
        await axios.post('/api/hidepopup', {
          'notification_id': this.notifies[this.i].id,
          'user_id': this.user_id,
          'read': this.read,
          'hide_next': this.hide_next,
        })
        .catch(function (error) { 
          console.log(error);
        })
        this.load = false;
      }
    },
    nextPopup : function () {
      if(this.a < this.notifies.length) {
        this.a++;
        this.b++;
        this.hide_next = false;
        this.read = false;
        this.i++;
      };
    },
  },
  async created() {
    if(sessionStorage.getItem('read') === null) {
      this.load = true;
      await axios.get('/api/notify')
      .then(response => {
        this.notifies = response.data.notifies;
        this.user_id = response.data.user_id;
        console.log(this.notifies);
        console.log(this.notifies[this.i].id);
        console.log(this.user_id);
        sessionStorage.setItem('read', 'true');
      })
      .catch(response => console.log(response));
      this.show();
      this.load = false;
    }
  }
}
</script>
<!-- CSS -->
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