<template>
  <div class="overflow-auto">
    <b-form-group>
      <b-input-group size="sm">
        <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Search..."></b-form-input>
        <b-input-group-append is-text id="btn-search" title="Search">
          <b-icon icon="search"></b-icon>
        </b-input-group-append>
      </b-input-group>
    </b-form-group>

    <b-table
      striped
      show-empty
      hover
      head-variant="light"
      table-variant="light"
      class="mt-3"
      :filter="filter"
      :filter-included-fields="filterOn"
      :bordered="true"
      :borderless="true"
      :fixed="true"
      :items="items"
      :per-page="perPage"
      :fields="fields"
      :currentPage="currentPage"
      @filtered="onFiltered"
    >
      <template #cell(name)="data">
        <!-- `data.value` is the value after formatted by the Formatter -->
        <a :href="`/?id=${data.value.id}`">{{ data.value.name }}</a>
      </template>
    </b-table>
    <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="fill" />
  </div>
</template>

<script>
export default {
  props: {
    data: Array
  },

  mounted() {
    this.totalRows = this.data.length;
    this.convertDataToDTO();
  },
  data() {
    return {
      totalRows: 1,
      currentPage: 1,
      perPage: 15,
      filter: null,
      filterOn: [],
      items: [],
      fields: [
        {
          key: "name",
          sortable: true,
          filterable: true
        },
        {
          key: "released",
          sortable: true
        },
        {
          key: "rate",
          //label: 'Person age',
          sortable: true
          //,variant: 'danger'
        },
        {
          key: "genres",
          sortable: false
        },
        {
          key: "platforms",
          sortable: false
        },
        {
          key: "publishers",
          sortable: false
        }
      ]
    };
  },
  methods: {
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    convertDataToDTO() {
      this.items = [];
      for (const iterator of this.data) {
        const item = {
          name: { name: iterator.name, id: iterator.id },
          released: new Date(iterator.released_date).getFullYear(),
          rate: iterator.rate,
          genres: iterator.genres.map(x => x.name).join(", "),
          platforms: iterator.platforms.map(x => x.name).join(", "),
          publishers: iterator.publishers.map(x => x.name).join(", ")
        };
        this.items.push(item);
      }
    }
  }
};
</script>
