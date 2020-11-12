<template>
  <b-form inline>
    <b-form-select
      v-for="filter in filters"
      v-bind:key="filter.uniqueName"
      :name="filter.uniqueName"
      class="mb-2 mr-sm-2 mb-sm-0"
      v-model="filter.value"
      :options="filter.options"
    ></b-form-select>
    <b-button type="submit" variant="primary" class="btn">Apply Filter(s)</b-button>
  </b-form>
</template>

<script>
export default {
  props: {
    items: Array
  },
  data() {
    return {
      defaultOption: { value: null, text: "Nothing Selected" }
    };
  },
  computed: {
    filters() {
      return this.items.map(item => {
        return {
          uniqueName: item.uniqueName,
          title: item.title,
          options: [this.defaultOption, ...item.options.map(option => ({ value: option.id, text: option.name }))],
          value: this.getQueryString("userLists") ? this.getQueryString("userLists") : null
        };
      });
    }
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
