<template>
  <b-row>
    <b-col lg=8>
      <div>You are logged in! <br />Your name is {{ this.user.name }}</div>
    </b-col>
  </b-row>
</template>

<script>
export default { 
  props: {
    user: {
      type: Object,
      default() {
        return {
          id: "",
          name: "",
          email: ""
        };
      }
    }
  },
  mounted() {},
  data() {
    return {
      markOptions: [
        { value: false, text: "False" },
        { value: true, text: "True" }
      ],
      seperators: ",;",
      isUpdateMode: false,
      form: {
        name: this.item.name,
        releasedDate: this.item.released_date ? this.item.released_date : "",
        rate: +this.item.rate,
        checked: this.item.checked === "1", // false as boolean, stores as 1 or 0 in database!
        description: this.item.description ? this.item.description : "",
        genres: this.item.genres.map(x => x.name),
        publishers: this.item.publishers.map(x => x.name),
        platforms: this.item.platforms.map(x => x.name),
        coverPic: null
      }
    };
  },
  methods: {
    onSubmit() {}
  }
};
</script>

<style lang="scss" scoped></style>
