<template>
  <div>
    <input v-model="name" placeholder="名前">
    <input v-model="company_name" placeholder="会社名">
    <input v-model="year" placeholder="設立年">
    <input v-model="company_headquarters" placeholder="本社">
    <input v-model="what_company_does" placeholder="どんな会社？">
    <button @click="addCeo">投稿</button>
    <loading-component v-if="show"></loading-component>
  </div>
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