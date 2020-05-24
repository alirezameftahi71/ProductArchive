<template>
  <b-form-tags
    :input-id="inputid"
    v-model="values"
    @input="$emit('update:selectedtags', values)"
    no-outer-focus
    class="p-0 no-bg"
    :separator="seperators"
  >
    <template v-slot="{ tags, inputAttrs, inputHandlers, tagVariant, addTag, removeTag }">
      <b-input-group class="mb-2">
        <b-form-input
          v-bind="inputAttrs"
          ref="input"
          v-on:input="onInputChange"
          v-on="inputHandlers"
          placeholder="To add tags press ; , or enter"
          class="form-control"
        ></b-form-input>
        <b-input-group-append>
          <b-button @click="addTag()" variant="outline-secondary">Add</b-button>
        </b-input-group-append>
      </b-input-group>
      <div class="dropdown-menu dropdown-items-container" :class="{ show: isDropdownVisible }">
        <a
          class="dropdown-item"
          v-for="item in suggestItems"
          :key="item.id"
          href="#"
          @click="
            addTag(item.name);
            isDropdownVisible = false;
          "
          >{{ item.name }}</a
        >
      </div>

      <div :class="{ 'd-inline-block': iscontainerstatic }">
        <b-form-tag v-for="tag in tags" @remove="removeTag(tag)" :key="tag" :title="tag" :variant="tagVariant" class="mr-1">{{
          tag
        }}</b-form-tag>
      </div>
    </template>
  </b-form-tags>
</template>

<script>
export default {
  props: {
    inputid: String,
    api: String,
    iscontainerstatic: Boolean,
    selectedtags: Array
  },
  data() {
    return {
      values: this.selectedtags,
      isDropdownVisible: false,
      seperators: ",;",
      suggestItems: []
    };
  },
  methods: {
    toLowerCaseOrDefault(val) {
      return (val || "").toLowerCase();
    },
    onInputChange(val) {
      val = val.trim();
      if (!val) {
        this.isDropdownVisible = false;
        this.suggestItems = [];
      } else {
        this.axios
          .get(this.api)
          .then(response => {
            const data = response.data.filter(x => this.toLowerCaseOrDefault(x.name).includes(this.toLowerCaseOrDefault(val)));
            this.suggestItems = data.splice(0, 4);
            this.isDropdownVisible = this.suggestItems && this.suggestItems.length;
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>
<style lang="scss" scoped>
.dropdown-items-container {
  top: initial;
  left: initial;
}
.no-bg {
  background: transparent;
  border: none;
}
</style>
