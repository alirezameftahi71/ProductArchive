<template>
  <form action="">
    <div id="filter-container" class="form-row">
      <div class="form-group col-md-3">
        <select id="is-unchecked" class="form-control custom-select" name="is-unchecked">
          <option value="false">Disable Only UnChecked</option>
          <option value="true" :selected="this.getQueryString('is-unchecked') == 'true'">Enable Only UnChecked</option>
        </select>
      </div>

      <div class="form-group col-md-3">
        <select id="high-rate" class="form-control custom-select" name="high-rate">
          <option value="false">Disable High Rate</option>
          <option value="true" :selected="this.getQueryString('high-rate') == 'true'">Enable High Rate</option>
        </select>
      </div>

      <div class="form-group col-md-3">
        <button type="submit" class="btn btn-primary">Apply Filter</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  methods: {
    getQueryString(queryStringName) {
      const queryObject = this.$route.query;
      return !queryStringName ? queryObject : queryObject[queryStringName];
    }
  }
};
</script>

<style lang="scss" scoped>
#filter-container {
  margin-top: 1.25em;
}

#grid-container {
  padding: 2.5px;
}
</style>
