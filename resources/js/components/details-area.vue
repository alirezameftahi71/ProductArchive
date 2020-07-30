<template>
  <b-row id="info-area" class="h-100">
    <b-col lg="8" md="7" order="2" order-md="1" order-sm="2">
      <info-grid :item="_dataItem"></info-grid>
    </b-col>
    <b-col lg="4" md="5" order="1" order-md="2" order-sm="1">
      <b-container fluid>
        <img id="cover-pic" class="img-fluid" :src="_dataItem.cover_pic" alt="Product Cover" width="265" height="320" />
      </b-container>
      <b-container class="my-1">
        <b-button-group size="sm">
          <b-button variant="light" class="icon border-0" :disabled="!_dataItem.id" title="Delete Item" @click="deleteItem()">
            <b-icon icon="trash-fill"></b-icon>
          </b-button>
          <b-button variant="light" class="icon border-0" :disabled="!_dataItem.id" title="Favorite Item" @click="heartItem()">
            <b-icon icon="heart-fill"></b-icon>
          </b-button>
          <b-button variant="light" class="icon border-0" :disabled="!_dataItem.id" title="Edit Item" @click="editItem()">
            <b-icon icon="pencil-square"></b-icon>
          </b-button>
          <b-button
            variant="light"
            class="icon border-0"
            title="Mark Item"
            :disabled="!_dataItem.id"
            @click="markItem()"
            :class="{ 'i-green': _dataItem.checked }"
          >
            <b-icon icon="check-circle"></b-icon>
          </b-button>
        </b-button-group>
      </b-container>
    </b-col>
    <b-col order="3">
      <div class="container-fluid">
        <p id="description">{{ _dataItem.description }}</p>
      </div>
    </b-col>
  </b-row>
</template>

<script>
export default {
  props: {
    item: Object
  },
  data() {
    return {
      dataItem: this.item
    };
  },
  computed: {
    _dataItem() {
      return this.dataItem
        ? {
            id: this.dataItem.id,
            name: this.dataItem.name,
            released_date: this.dataItem.released_date,
            rate: this.dataItem.rate,
            description: this.dataItem.description,
            cover_pic: this.dataItem.cover_pic ? `storage/${this.dataItem.cover_pic}` : "storage/assets/default.png",
            checked: this.dataItem.checked == "1",
            genres: this.dataItem.genres,
            platforms: this.dataItem.platforms,
            publishers: this.dataItem.publishers
          }
        : {
            id: null,
            name: "-",
            released_date: "-",
            rate: "-",
            description: "-",
            cover_pic: "storage/assets/default.png",
            checked: false,
            genres: [{ name: "-" }],
            platforms: [{ name: "-" }],
            publishers: [{ name: "-" }]
          };
    }
  },
  created() {
    this.$root.$on("selection-changed", item => (this.dataItem = item));
    this.$root.$on("delete-confirmed", () => this.onItemDeleteConfirm());
  },
  methods: {
    editItem() {
      this.$root.redirectTo(`/edit/${this.dataItem.id}`);
    },
    deleteItem() {
      this.$root.$emit("item-delete-clicked", this.dataItem);
    },
    markItem() {
      this.axios
        .post(`/api/games/toggleChecked/${this.dataItem.id}`)
        .then(async response => {
          this.$root.showSuccessMessage([
            this.$createElement("b", response.data.name),
            " is marked as ",
            response.data.checked ? "checked." : "unchecked."
          ]);
          this.dataItem.checked = response.data.checked;
        })
        .catch(error => {
          console.error(error);
        });
    },
    heartItem() {
      // TODO: implement this functionality
    },
    onItemDeleteConfirm() {
      this.axios
        .delete(`/api/games/${this.dataItem.id}`)
        .then(response => {
          this.$root.showSuccessMessage([this.$createElement("b", response.data.name), " is deleted."]);
        })
        .catch(error => {
          console.error(error);
        });
      this.$root.$emit("item-deleted", this.dataItem);
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../../sass/variables";

.icon {
  background-color: $milk;
  &:not([disabled]) {
    cursor: pointer;

    &:hover {
      color: $blue;
    }

    &.i-green {
      color: green;

      &:active {
        color: green;
      }
    }

    &.i-red {
      color: red;

      &:active {
        color: red;
      }
    }
  }
  &[disabled] {
    cursor: initial;
  }
}
</style>
