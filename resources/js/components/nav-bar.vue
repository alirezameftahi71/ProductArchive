<template>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand fas fa-archive" :title="logo.title" :href="logo.link"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav-bar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item" v-for="button in buttons" :key="button.link">
          <a class="nav-link" :href="button.link" :title="button.title">{{ button.title }}</a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      logo: {
        title: "Home",
        link: "/"
      },
      buttons: [
        {
          title: "Home",
          link: "/"
        },
        {
          title: "Create",
          link: "/create"
        },
        {
          title: "Gridview",
          link: "/gridview"
        }
      ]
    };
  },
  mounted() {
    this.makeCurrentLinkActive();
  },
  methods: {
    makeCurrentLinkActive() {
      const url = Array.from(document.querySelectorAll("ul.navbar-nav a")).find(
        x => `${window.location.origin}${window.location.pathname}` === x.href
      );
      url && url.parentElement.classList.add("active");
    }
  }
};
</script>

<style lang="scss"></style>
