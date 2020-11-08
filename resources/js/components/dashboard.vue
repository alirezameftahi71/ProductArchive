<template>
  <b-row>
    <b-col md="12" lg="3">
      <div>You are logged in! <br />Your name is {{ this.user.name }}</div>
    </b-col>
    <b-col md="12" lg="9"> </b-col>
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
      userLists: [
        { id: 1, name: "ali" },
        { id: 2, name: "ali" }
      ],
      form: {}
    };
  },
  methods: {
    onSubmit() {}
  }
};
</script>

<style lang="scss" scoped></style>
