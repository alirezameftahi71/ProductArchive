<template>
  <b-form @submit.prevent="onSubmit">
    <div class="row content justify-content-center">
      <div class="col-md-8">
        <b-form-group label="Name" label-for="name">
          <b-form-input id="name" v-model="form.name" type="text" required placeholder="Name"></b-form-input>
        </b-form-group>
        <div class="row">
          <div class="col-md-4">
            <b-form-group label="Released Date" label-for="released-date">
              <b-form-datepicker id="released-date" v-model="form.releasedDate" placeholder="Date of release"></b-form-datepicker>
            </b-form-group>
          </div>
          <div class="col-md-4">
            <b-form-group label="Marked" label-for="checked">
              <b-form-select id="checked" v-model="form.checked" placeholder="Marked" :options="markOptions"></b-form-select>
            </b-form-group>
          </div>
          <div class="col-md-4">
            <b-form-group label="Metascore" label-for="rate">
              <b-form-spinbutton
                id="rate"
                v-model="form.rate"
                placeholder="Metascore"
                min="1"
                max="5"
                step="0.5"
              ></b-form-spinbutton>
            </b-form-group>
          </div>
        </div>
        <b-form-group label="Genres" label-for="genres">
          <tag-autocomplete inputid="genres" api="/api/genres" :selectedtags.sync="form.genres"></tag-autocomplete>
        </b-form-group>
        <b-form-group label="Platforms" label-for="platforms">
          <tag-autocomplete inputid="platforms" api="/api/platforms" :selectedtags.sync="form.platforms"></tag-autocomplete>
        </b-form-group>
        <b-form-group label="Publishers" label-for="publishers">
          <tag-autocomplete inputid="publishers" api="/api/publishers" :selectedtags.sync="form.publishers"></tag-autocomplete>
        </b-form-group>
      </div>
      <div class="col-md-4">
        <b-form-group label="Description" label-for="description">
          <b-form-textarea
            id="description"
            v-model="form.description"
            placeholder="Description"
            rows="14"
            no-resize
          ></b-form-textarea>
        </b-form-group>
        <b-form-group label="Cover Picture" label-for="cover_pic" class="mt-4">
          <b-form-file
            id="cover_pic"
            v-model="form.coverPic"
            placeholder="Cover Picture"
            accept="image/jpeg, image/png"
            :file-name-formatter="formatCoverPicName"
          ></b-form-file>
        </b-form-group>
      </div>
    </div>
    <div class="row content justify-content-center mb-3">
      <div class="col-md-12">
        <b-button type="submit" variant="primary">Submit</b-button>
      </div>
    </div>
  </b-form>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      default() {
        return {
          name: "",
          released_date: "",
          rate: 1,
          checked: false,
          genres: [],
          platforms: [],
          publishers: [],
          description: "",
          cover_pic: null
        };
      }
    }
  },
  mounted() {
    this.isUpdateMode = !!this.item.id;
  },
  data() {
    return {
      markOptions: [
        { value: false, text: "False" },
        { value: true, text: "True" }
      ],
      seperators: ",;",
      isUpdateMode: false,
      form: {
        name: this.item.name,
        releasedDate: this.item.released_date ? this.item.released_date : "",
        rate: +this.item.rate,
        checked: this.item.checked === "1", // false as boolean, stores as 1 or 0 in database!
        description: this.item.description ? this.item.description : "",
        genres: this.item.genres.map(x => x.name),
        publishers: this.item.publishers.map(x => x.name),
        platforms: this.item.platforms.map(x => x.name),
        coverPic: null
      }
    };
  },
  methods: {
    onSubmit() {
      const url = this.isUpdateMode ? `/api/games/${this.item.id}` : "/api/games";
      const formData = new FormData();
      Object.keys(this.form).forEach(key => formData.append(key, this.form[key]));
      this.axios
        .post(url, formData)
        .then(response => {
          const messagePostFix = this.createSuccessfullSubmitPostMessage();
          this.$root.showSuccessMessage([this.$createElement("b", response.data.name), messagePostFix]);
          this.$root.redirectTo(`/?id=${response.data.id}`);
        })
        .catch(error => console.error(error));
    },
    createSuccessfullSubmitPostMessage() {
      return this.isUpdateMode ? " updated successfully." : " is stored in database.";
    },
    formatCoverPicName(file) {
      return file[0].name.substr(0, 20);
    }
  }
};
</script>

<style lang="scss" scoped></style>
