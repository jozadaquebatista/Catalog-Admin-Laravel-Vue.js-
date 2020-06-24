<template>
    <div>
        <!-- Navigation Drawer -->
        <v-navigation-drawer class="blue-grey darken-3" app dark permanent left>

          <template v-slot:prepend>
            <v-list-item two-line>

              <v-list-item-avatar>
                <img :src="avatar">
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Olá, {{user.name}}!</v-list-item-title>
                <v-list-item-subtitle>{{user.email}}</v-list-item-subtitle>
              </v-list-item-content>

            </v-list-item>
          </template>

          <v-divider></v-divider>

          <v-list dense>
            <v-list-item v-for="item in menu" :key="item.title" @click="item.navigate()">
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <template v-slot:append>
            <div class="pa-4">
              <v-btn block @click.prevent="signOut">Logout</v-btn>
            </div>
          </template>

        </v-navigation-drawer>
        <!-- Navigation Drawer -->
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    data () {
        return {
          avatar: `https://randomuser.me/api/portraits/women/${Math.round(Math.random() * 100)}.jpg`,
          menu: [],
        }
    },
    beforeMount() {

      if(this.authenticated) this.$router.push({ path: '/products' });

      // menu build
      [
        {
          title: 'Home',
          icon: 'mdi-home-city',
          navigate: () => this.$router.push({ path: '/products' }),
          show: true
        },
        {
          title: 'Novo Produto',
          icon: 'mdi-folder-plus',
          navigate: () => this.$router.push({ path: '/products/form' }),
          show: !this.user.admin
        }
      ].forEach(item => { if(item.show) this.menu.push(item) });

    },
    computed: {
        ...mapGetters({
            authenticated: 'authenticated',
            user: 'user',
        })
    },
    methods: {
        ...mapActions({
            logout: 'signOut'
        }),
        signOut() {
            this.logout().then(() => {
                console.log('saiu');
            });
        }
    }
}
</script>
