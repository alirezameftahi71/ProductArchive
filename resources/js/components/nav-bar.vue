<template>
  <div>
    <b-navbar toggleable="md" type="dark" variant="dark">
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
          <!-- <b-nav-form>
            <b-form-input size="sm" class="mr-sm-2" placeholder="Search"></b-form-input>
            <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
          </b-nav-form> -->

          <!-- <b-nav-item-dropdown text="Lang" right>
            <b-dropdown-item href="#">EN</b-dropdown-item>
            <b-dropdown-item href="#">ES</b-dropdown-item>
            <b-dropdown-item href="#">RU</b-dropdown-item>
            <b-dropdown-item href="#">FA</b-dropdown-item>
          </b-nav-item-dropdown> -->

          <b-nav-item-dropdown right>
            <!-- <li class="nav-item dropdown">
              <a
                id="navbarDropdown"
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-pre
              >
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a
                  class="dropdown-item"
                  href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                >
                  {{ __("Logout") }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li> -->

            <template v-slot:button-content>
              <span>{{ username }}</span>
            </template>
            <b-dropdown-item href="#">Profile</b-dropdown-item>
            <b-dropdown-item href="#" @click="signOut">Sign Out</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
export default {
  props: {
    username: {
      type: String,
      default: null
    }
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
    },
    signOut(event) {
      event.preventDefault();
      document.getElementById("logout-form").submit();
    }
  }
};
</script>

<style lang="scss" scoped></style>
