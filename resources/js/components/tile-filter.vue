<template>
  <form action="">
    <div class="form-row">
      <div class="form-group col-md-3 mb-lg-0 mb-md-0 mb-sm-3 mb-3">
        <select id="is-unchecked" class="form-control custom-select" name="is-unchecked">
          <option value="false">Disable Only UnChecked</option>
          <option value="true" :selected="this.getQueryString('is-unchecked') == 'true'">Enable Only UnChecked</option>
        </select>
      </div>

      <div class="form-group col-md-3 mb-lg-0 mb-md-0 mb-sm-3 mb-3">
        <select id="high-rate" class="form-control custom-select" name="high-rate">
          <option value="false">Disable High Rate</option>
          <option value="true" :selected="this.getQueryString('high-rate') == 'true'">Enable High Rate</option>
        </select>
      </div>

      <div class="form-group col-md-3 mb-lg-0 mb-md-0 mb-sm-0 mb-0">
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

<style lang="scss" scoped></style>
