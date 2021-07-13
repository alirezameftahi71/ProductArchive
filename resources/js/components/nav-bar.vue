<template>
  <b-navbar toggleable="md" type="dark" variant="dark">
    <b-container fluid>
      <b-container>
        <b-navbar-brand :title="logo.title" :href="logo.link">
          <b-icon icon="archive-fill"></b-icon>
        </b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-item v-for="button in buttons" :key="button.link" :href="button.link" :title="button.title">
              {{ button.title }}
            </b-nav-item>
          </b-navbar-nav>

          <!-- Right aligned nav items -->
          <b-navbar-nav class="ml-auto">
            <b-nav-item-dropdown right v-if="user">
              <template v-slot:button-content>
                <span>{{ user.name }}</span>
              </template>
              <b-dropdown-item :href="profileLink" title="Profile">Profile</b-dropdown-item>
              <b-dropdown-item href="#" @click="signOut" title="Sign Out">Sign Out</b-dropdown-item>
            </b-nav-item-dropdown>
            <template right v-else>
              <b-nav-item href="/login" title="Login">
                Login
              </b-nav-item>
              <b-nav-item href="/register" title="Register">
                Register
              </b-nav-item>
            </template>
          </b-navbar-nav>
        </b-collapse>
      </b-container>
    </b-container>
  </b-navbar>
</template>

<script>
export default {
  props: {
    user: Object
  },
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
        },
        {
          title: "Tableview",
          link: "/tableview"
        }
      ]
    };
  },
  mounted() {
    this.makeCurrentLinkActive();
  },
  computed: {
    profileLink() {
      return this.user ? `/profile/${this.user.id}` : null;
    }
  },
  methods: {
    makeCurrentLinkActive() {
      const url = Array.from(document.querySelectorAll("ul.navbar-nav a")).find(
        x => `${window.location.origin}${window.location.pathname}` === x.href
      );
      url && url.parentElement.classList.add("active");
    },
    signOut(event) {
      event.preventDefault();
      document.getElementById("logout-form").submit();
    }
  }
};
</script>

<style lang="scss" scoped></style>
