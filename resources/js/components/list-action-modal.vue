<template>
  <b-modal v-model="show" title="Add item to List" hide-footer>
    <b-container fluid>
      <b-form @submit.prevent="addNewUserList()">
        <b-input-group>
          <b-form-input v-model="newListValue" placeholder="New List Name..."></b-form-input>
          <b-input-group-append>
            <b-button variant="primary" @click="addNewUserList()">
              <b-icon icon="cloud-upload" aria-hidden="true"></b-icon> Save
            </b-button>
          </b-input-group-append>
        </b-input-group>
      </b-form>

      <br />

      <b-table :items="items" :fields="fields" responsive="sm" v-show="items && items.length" striped fixed hover>
        <template #cell(listName)="row">
          <b-form-input
            autofocus
            size="sm"
            v-if="userListUpdatingId == row.item.id"
            v-model="row.item.listName"
            @blur="onListNameUpdateBlur(row.item)"
          ></b-form-input>
          <span v-else @dblclick="userListUpdatingId = row.item.id">{{ row.item.listName }}</span>
        </template>
        <template #cell(isItemIncluded)="row">
          <b-form-checkbox v-model="row.item.isItemIncluded" @change="addCurrentItemToList(row.item.id)"></b-form-checkbox>
        </template>
      </b-table>
    </b-container>
  </b-modal>
</template>

<script>
export default {
  props: {
    lists: Array
  },
  created() {
    this.$root.$on("list-action-clicked", item => {
      this.currentItem = item;
      this.show = true;
    });
  },
  computed: {
    items() {
      return this.userLists
        .filter(x => x.id && x.name !== "Favorites")
        .map(x => {
          return {
            id: x.id,
            listName: x.name,
            isItemIncluded: this.currentItem ? x.games.some(a => a.id === this.currentItem.id) : false
          };
        });
    }
  },
  data() {
    return {
      fields: ["listName", "isItemIncluded"],
      userListUpdatingId: null,
      show: false,
      userLists: this.lists,
      newListValue: "",
      currentItem: null
    };
  },
  methods: {
    onListNameUpdateBlur(userListRowItem) {
      this.userListUpdatingId = null;
      const formData = new FormData();
      formData.append("name", userListRowItem.listName);
      this.axios
        .post(`/api/lists/${userListRowItem.id}`, formData)
        .then(() => {
          this.$root.showSuccessMessage(["List name changed successfully."]);
        })
        .catch(error => {
          console.error(error);
        });
    },
    addCurrentItemToList(userListId) {
      const formData = new FormData();
      formData.append("list_id", userListId);
      formData.append("game_ids", [this.currentItem.id]);
      this.axios
        .post(`/api/games/addToList`, formData)
        .then(response => {
          this.$root.showSuccessMessage([
            this.$createElement("b", this.currentItem.name),
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
      const newListName = this.newListValue.trim();
      if (newListName) {
        const formData = new FormData();
        formData.append("name", newListName);
        this.axios
          .post(`/api/lists`, formData)
          .then(response => {
            this.$root.showSuccessMessage(["List ", this.$createElement("b", response.data.name), " is created."]);
            this.userLists.push(response.data);
            this.newListValue = "";
          })
          .catch(error => {
            console.error(error);
          });
      }
    }
  }
};
</script>
<style lang="scss" scoped>
.btn-bg-transparent {
  background-color: transparent;
}
</style>
