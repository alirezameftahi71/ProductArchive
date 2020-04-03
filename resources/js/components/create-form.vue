<template>
  <b-form @submit="onSubmit" @reset="onReset">
    <div class="row content justify-content-center">
      <div class="col-md-8">
        <b-form-group label="Name:" label-for="name">
          <b-form-input id="name" v-model="form.name" type="text" required placeholder="Name"></b-form-input>
        </b-form-group>
        <div class="row">
          <div class="col-md-4">
            <b-form-group label="Released Date:" label-for="released-date">
              <b-form-datepicker id="released-date" v-model="form.releasedDate" placeholder="Date of release"></b-form-datepicker>
            </b-form-group>
          </div>
          <div class="col-md-4">
            <b-form-group label="Marked:" label-for="isChecked">
              <b-form-select id="isChecked" v-model="form.isChecked" placeholder="Marked" :options="markOptions"></b-form-select>
            </b-form-group>
          </div>
          <div class="col-md-4">
            <b-form-group label="Metascore:" label-for="rate">
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
        <b-form-group label="Genres:" label-for="genres" description="Press , or ; to add tags">
          <b-form-tags input-id="genres" v-model="form.genres" placeholder="Genres" :separator="seperators"></b-form-tags>
        </b-form-group>
        <b-form-group label="Platforms:" label-for="platforms" description="Press , or ; to add tags">
          <b-form-tags
            input-id="platforms"
            v-model="form.platforms"
            placeholder="Platforms"
            :separator="seperators"
          ></b-form-tags>
        </b-form-group>
        <b-form-group label="Publishers:" label-for="publishers" description="Press , or ; to add tags">
          <b-form-tags
            input-id="publishers"
            v-model="form.publishers"
            placeholder="Publishers"
            :separator="seperators"
          ></b-form-tags>
        </b-form-group>
      </div>
      <div class="col-md-4">
        <b-form-group label="Description:" label-for="description">
          <b-form-textarea
            id="description"
            v-model="form.description"
            placeholder="Description"
            rows="14"
            no-resize
          ></b-form-textarea>
        </b-form-group>
        <b-form-group label="Cover Picture:" label-for="coverPic" class="mt-4">
          <b-form-file
            id="coverPic"
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
        <b-button type="reset" variant="danger">Reset</b-button>
      </div>
    </div>
  </b-form>
</template>

<script>
export default {
  data() {
    return {
      defaultForm: {
        name: "",
        releasedDate: "",
        rate: 1,
        isChecked: false,
        genres: [],
        platforms: [],
        publishers: [],
        description: "",
        coverPic: null
      },
      form: {
        name: "",
        releasedDate: "",
        rate: 1,
        isChecked: false,
        genres: [],
        platforms: [],
        publishers: [],
        description: "",
        coverPic: null
      },
      markOptions: [
        { value: false, text: "False" },
        { value: true, text: "True" }
      ],
      seperators: ",;"
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      alert(JSON.stringify(this.form));
    },
    onReset(evt) {
      evt.preventDefault();
      this.form = this.defaultForm;
    },
    formatCoverPicName(file) {
      return file[0].name.substr(0, 20);
    }
  }
};
</script>

<style lang="scss" scoped>
input.tm-input.input-loading {
  background-color: white;
  background-image: url("/assets/input-loading.gif");
  background-size: 25px 25px;
  background-position: right center;
  background-repeat: no-repeat;
}
</style>
