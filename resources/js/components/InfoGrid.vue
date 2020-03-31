<template>
  <table id="info-table" class="table table-bordered table-striped fixed-width-table">
    <tbody>
      <tr>
        <th>Name</th>
        <td id="name" v-html="!!item ? item.name : '-'"></td>
      </tr>
      <tr>
        <th>Release Date</th>
        <td id="releasedDate">{{ !!item ? item.released_date : "-" }}</td>
      </tr>
      <tr>
        <th>Genre(s)</th>
        <td id="genre">{{ getJoinedItems(item.genres) }}</td>
      </tr>
      <tr>
        <th>Platform(s)</th>
        <td id="platform">{{ getJoinedItems(item.platforms) }}</td>
      </tr>
      <tr>
        <th>Publisher(s)</th>
        <td id="publisher">{{ getJoinedItems(item.publishers) }}</td>
      </tr>
      <tr>
        <th>Rate</th>
        <td id="rate">{{ !!item ? `${item.rate} / 5.0` : "-" }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: {
    item: Object
  },
  methods: {
    getJoinedItems(items = []) {
      return items.map((x) => x.name).join(", ");
    }
  }
};
</script>

<style lang="scss">
@import "../../sass/variables";
.table-striped tbody tr:nth-of-type(even) {
  background-color: $lightmilk;
}
</style>
