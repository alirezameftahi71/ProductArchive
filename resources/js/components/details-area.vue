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
          <b-button variant="light" class="icon border-0" :disabled="!_dataItem.id" title="Edit Item" @click="editItem()">
            <b-icon icon="pencil-square"></b-icon>
          </b-button>
          <b-button
            variant="light"
            class="icon border-0"
            :class="{ 'i-red': _dataItem.isHearted }"
            :disabled="!_dataItem.id"
            title="Favorite Item"
            @click="heartItem()"
          >
            <b-icon icon="heart-fill"></b-icon>
          </b-button>
          <b-dropdown
            variant="light"
            menu-class="user-list-actions-container"
            toggle-class="text-decoration-none icon border-0"
            block
            no-caret
          >
            <template #button-content><b-icon icon="bookmark-plus"></b-icon></template>
            <b-dropdown-group id="dropdown-group-1" header="Create a new list and add to it">
              <b-dropdown-form :inline="true">
                <b-form-group>
                  <b-form-input v-model="newListValue" size="sm" placeholder="Wishlist" />
                  <b-button size="sm" variant="primary" @click="addNewUserList()">Save</b-button>
                </b-form-group>
              </b-dropdown-form>
            </b-dropdown-group>
            <b-dropdown-divider v-show="_userLists.length" />
            <b-dropdown-group id="dropdown-group-1" header="User Lists" v-show="_userLists.length">
              <b-dropdown-item
                v-for="userList in _userLists"
                v-bind:key="userList.id"
                @click.prevent="addCurrentItemToList(userList.id)"
                >{{ userList.name }}</b-dropdown-item
              >
            </b-dropdown-group>
          </b-dropdown>
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
    item: Object,
    lists: Array,
    hearted: Boolean
  },
  data() {
    return {
      dataItem: this.item,
      isHearted: this.hearted,
      newListValue: null,
      userLists: this.lists
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
            genres: this.dataItem.genres,
            platforms: this.dataItem.platforms,
            publishers: this.dataItem.publishers,
            isHearted: this.isHearted
          }
        : {
            id: null,
            name: "-",
            released_date: "-",
            rate: "-",
            description: "-",
            cover_pic: "storage/assets/default.png",
            genres: [{ name: "-" }],
            platforms: [{ name: "-" }],
            publishers: [{ name: "-" }],
            isHearted: false
          };
    },
    _userLists() {
      return this.userLists ? this.userLists.filter(x => x.name != "Favorites") : [];
    }
  },
  created() {
    this.$root.$on("selection-changed", ({ item, isHearted }) => {
      this.dataItem = item;
      this.isHearted = isHearted;
    });
    this.$root.$on("delete-confirmed", () => this.onItemDeleteConfirm());
  },
  methods: {
    editItem() {
      this.$root.redirectTo(`/edit/${this.dataItem.id}`);
    },
    deleteItem() {
      this.$root.$emit("item-delete-clicked", this.dataItem);
    },
    heartItem() {
      this.axios
        .post(`/api/games/heart/${this.dataItem.id}`)
        .then(response => {
          this.$root.showSuccessMessage([
            this.$createElement("b", this.dataItem.name),
            " is marked as ",
            response.data ? "favorite." : "unfavorite."
          ]);
          this.isHearted = response.data;
        })
        .catch(error => {
          console.error(error);
        });
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
    },
    addCurrentItemToList(userListId) {
      const formData = new FormData();
      formData.append("list_id", userListId);
      formData.append("game_ids", [this._dataItem.id]);
      this.axios
        .post(`/api/games/add`, formData)
        .then(response => {
          this.$root.showSuccessMessage([
            this.$createElement("b", this._dataItem.name),
            " is added to list ",
            this.$createElement("b", response.data.name),
            "."
          ]);
        })
        .catch(error => {
          console.error(error);
        });
    },
    addNewUserList() {
      if (this.newListValue) {
        const formData = new FormData();
        formData.append("name", this.newListValue);
        this.axios
          .post(`/api/lists`, formData)
          .then(response => {
            this.$root.showSuccessMessage(["List ", this.$createElement("b", response.data.name), " is created."]);
            this.userLists.push(response.data);
          })
          .catch(error => {
            console.error(error);
          });
      }
    }
  }
};
</script>

<style lang="scss">
@import "../../sass/variables";
.user-list-actions-container {
  width: 261px;
}
.icon {
  background-color: $milk;
  padding: 4px 8px;
  &:not([disabled]) {
    cursor: pointer;

    &:hover {
      color: $blue;
    }

    &.i-green {
      color: green;

      &:active {
        color: #06ac06;
      }

      &:hover {
        color: #2ae92a;
      }
    }

    &.i-red {
      color: red;

      &:active {
        color: #df1616;
      }

      &:hover {
        color: #ff4848;
      }
    }
  }
  &[disabled] {
    cursor: initial;
  }
}
</style>
