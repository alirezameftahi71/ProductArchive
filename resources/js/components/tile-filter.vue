<template>
  <form action="">
    <div id="filter-container" class="form-row">
      <div class="form-group col-md-3">
        <select id="is-checked" class="form-control custom-select" name="is-checked">
          <option value="0">Disable Only UnChecked</option>
          <option value="1" :selected="this.getQueryString('is-checked') == '1'">Enable Only UnChecked</option>
        </select>
      </div>

      <div class="form-group col-md-3">
        <select id="high-rate" class="form-control custom-select" name="high-rate">
          <option value="0">Disable High Rate</option>
          <option value="1" :selected="this.getQueryString('high-rate') == '1'">Enable High Rate</option>
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

<style lang="scss">
#filter-container {
  margin-top: 1.25em;
}

#grid-container {
  padding: 2.5px;
}
</style>
