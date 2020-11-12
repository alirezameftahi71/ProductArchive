<template>
  <b-modal v-model="show" title="Add item to List" hide-footer>
    <b-container fluid>
      <b-form inline>
        <label class="sr-only" for="inline-form-input-name">New list name</label>
        <b-form-input v-model="newListValue" class="mb-2 mr-sm-2 mb-sm-0" placeholder="New list name..."></b-form-input>
        <b-button variant="primary" @click="addNewUserList()">Save</b-button>
      </b-form>
      <br />
      <b-table :items="items" :fields="fields" responsive="sm" v-show="items && items.length" striped fixed hover>
        <template #cell(isItemIncluded)="row">
          <b-form-checkbox v-model="row.item.isItemIncluded" @change="addCurrentItemToList(row.item.id)" switch></b-form-checkbox>
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
      show: false,
      userLists: this.lists,
      newListValue: "",
      currentItem: null
    };
  },
  methods: {
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
      if (this.newListValue) {
        const formData = new FormData();
        formData.append("name", this.newListValue);
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
