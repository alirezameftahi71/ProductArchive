<template>
  <table id="info-table" class="table table-bordered table-striped fixed-width-table">
    <tbody>
      <tr>
        <th>Name</th>
        <td id="name">{{ !!computedItem ? computedItem.name : '-' }}</td>
      </tr>
      <tr>
        <th>Release Date</th>
        <td id="releasedDate">{{ !!computedItem ? computedItem.released_date : '-' }}</td>
      </tr>
      <tr>
        <th>Genre(s)</th>
        <td id="genre">{{ getJoinedItems(computedItem.genres) }}</td>
      </tr>
      <tr>
        <th>Platform(s)</th>
        <td id="platform">{{ getJoinedItems(computedItem.platforms) }}</td>
      </tr>
      <tr>
        <th>Publisher(s)</th>
        <td id="publisher">{{ getJoinedItems(computedItem.publishers) }}</td>
      </tr>
      <tr>
        <th>Rate</th>
        <td id="rate">{{ !!computedItem ? `${computedItem.rate} / 5.0` : '-' }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: {
    item: Object
  },
  data() {
    return {
      computedItem: this.item,
    }
  },
  created() {
    this.$root.$on('selectionchanged', item => this.computedItem = item);
  },
  methods: {
    getJoinedItems(items = []) {
      return items.map(x => x.name).join(", ");
    }
  }
};
</script>

<style lang="scss">
</style>