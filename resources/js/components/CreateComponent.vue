<template>
  <div>
    <input v-model="name" placeholder="名前">
    <input v-model="company_name" placeholder="会社名">
    <input v-model="year" placeholder="設立年">
    <input v-model="company_headquarters" placeholder="本社">
    <input v-model="what_company_does" placeholder="どんな会社？">
    <button @click="addCeo">投稿</button>
  </div>
</template>

<script>
export default {
  data () {
    return {
      name: '',
      company_name: '',
      year: '',
      company_headquarters: '',
      what_company_does: '',
      ceos: [],
    };
  },
  methods: {
    addCeo() {
      axios.post('api/ceo', {
        name: this.name,
        company_name: this.company_name,
        year: this.year,
        company_headquarters: this.company_headquarters,
        what_company_does: this.what_company_does,
      })
      .then(function (response) {
        console.log(response);
        location.href = '/ceoindex'
      })
      .catch(function (error) {
        console.log(error);
      })
      this.$router.push(this.$route.query.redirect);
    }
  },

}
</script>