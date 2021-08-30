<template>
  <v-app>
    <component v-bind:is="layout"></component>
  </v-app>
</template>

<script>
import LoginSignupLayout from './layouts/LoginSignupLayout'
import BasicAppLayout from './layouts/BasicAppLayout'
export default {
  computed: {
    layout () {
      return this.$store.getters.layout
    }
  },
  components: {
    'basic-app-layout': BasicAppLayout,
    'login-signup-layout': LoginSignupLayout
    // define as many layouts you want for the application
  }
}
</script>