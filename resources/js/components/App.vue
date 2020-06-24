<template>
  <v-app>

    <Login v-if="!authenticated"/>

    <div v-else>
      <Drawer/>
      <v-main>    
        <v-container fluid>
        <router-view></router-view>
        </v-container>
      </v-main>
    </div>

  </v-app>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                authenticated: 'authenticated'
            })
        }
    }
</script>

<style>
  * { user-select: none; }
</style>
