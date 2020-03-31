<template>
  <div>
    <b-navbar toggleable="md" type="dark" variant="dark">
      <b-navbar-brand class="fas fa-archive" :title="logo.title" :href="logo.link"></b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item v-for="button in buttons" :key="button.link" :href="button.link" :title="button.title">
            {{ button.title }}
          </b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
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
