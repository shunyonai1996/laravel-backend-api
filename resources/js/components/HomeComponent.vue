<template>
  <div class="style1">
    <h1>{{ message }}</h1>
    <p v-for="user in users">{{ user.name }} / {{ user.email }}</p>
    <p v-show="errorFlag">サーバとの通信にエラーが発生しています</p>
      <div>
        <button v-on:click="show" class="button">show!</button>
        <modal name="hello-world" :draggable="true" :resizable="true">
          <div class="modal-header">
            <h2>"vue-js-modal"ライブラリを使用</h2>
          </div>
          <div class="modal-body">
            <p>you're reading this text in a modal!</p>
            <button v-on:click="hide">閉じる</button>
          </div>
        </modal>
      </div>
  </div> 
</template>

<script>
export default {
  data() {
    return {
        message: 'Hello Axios',
        users: [],
        errorFlag: false
    };
  },
  mounted() {
    axios.get('/api/user')
    .then(response => {
      this.users = response.data.users
      console.log(response.status)
      console.log(response.headers)
      console.log(response.statusText)
      console.log(response.config)   
      console.log(response.data)
      console.log(this.users)
    })
    .catch(response => console.log(response));
  },
  methods: {
    show : function() {
      this.$modal.show('hello-world');
    },
    hide : function () {
      this.$modal.hide('hello-world');
    },
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