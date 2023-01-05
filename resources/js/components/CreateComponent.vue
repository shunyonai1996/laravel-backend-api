<template>
  <form class="container">
    <div class="mb-3">
      <label for="name" class="form-label">CEO名</label>
      <input class="form-control" id="name" v-model="name" placeholder="山田 太郎">
    </div>
    <div class="mb-3">
      <label for="company" class="form-label">会社名</label>
      <input class="form-control" id="company" v-model="company_name" placeholder="〇〇株式会社">
    </div>
    <div class="mb-3">
      <label for="year" class="form-label">設立年</label>
      <input class="form-control" id="year" v-model="year" placeholder="2002">
    </div>
    <div class="mb-3">
      <label for="main_office" class="form-label">本社</label>
      <input class="form-control" id="main_office" v-model="company_headquarters" placeholder="東京都杉並区">
    </div>
    <div class="mb-3">
      <label for="about" class="form-label">どんな会社？</label>
      <input class="form-control" id="about" v-model="what_company_does" placeholder="テクノロジー">
    </div>
    <div class="mb-3">
      <button @click="addCeo" type="submit" class="btn btn-primary">投稿</button>
    </div>
    <loading-component v-if="show"></loading-component>
  </form>
</template>

<script>
// author 米内
export default {
  
    data () {
    return {
        name: '',
        company_name: '',
        year: '',
        company_headquarters: '',
        what_company_does: '',
        ceos: [],
        show: false
    };
    },

    methods: {
        /**
         * CEO登録処理
         * 
         * @param {string} name
         * @param {string} company_name
         * @param {number} year
         * @param {string} company_headquarters
         * @param {string} what_company_does
         */
        addCeo() {
            let self = this;
            this.show = true;
            console.log(this.show)

            axios.post('api/ceo', {
              name: this.name,
              company_name: this.company_name,
              year: this.year,
              company_headquarters: this.company_headquarters,
              what_company_does: this.what_company_does,
            })
            .then(function () {
              location.href = '/ceo';
            })
            .catch(function (error) {
              console.log(error);
            })

            self.show = false
            this.$router.push(this.$route.query.redirect);
        }
    },

}
</script>