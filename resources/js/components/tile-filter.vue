<template>
  <b-form inline>
    <b-form-select
      name="is-unchecked"
      id="filterCheckedSelect"
      class="mb-2 mr-sm-2 mb-sm-0"
      v-model="selectedChecked"
      :options="optionsChecked"
    ></b-form-select>
    <b-form-select
      name="high-rate"
      id="filterHighRateSelect"
      class="mb-2 mr-sm-2 mb-sm-0"
      v-model="selectedHighRate"
      :options="optionsHighRate"
    ></b-form-select>
    <b-button type="submit" variant="primary" class="btn">Apply Filter</b-button>
  </b-form>
</template>

<script>
export default {
  data() {
    return {
      optionsChecked: [
        { value: "false", text: "Disable Only UnChecked" },
        { value: "true", text: "Enable Only UnChecked" }
      ],
      optionsHighRate: [
        { value: "false", text: "Disable High Rate" },
        { value: "true", text: "Enable High Rate" }
      ],
      selectedChecked: this.getQueryString("is-unchecked") || "false",
      selectedHighRate: this.getQueryString("high-rate") || "false"
    };
  },
  methods: {
    getQueryString(queryStringName) {
      const queryObject = this.$route.query;
      return !queryStringName ? queryObject : queryObject[queryStringName];
    }
  }
};
</script>

<style lang="scss" scoped></style>
