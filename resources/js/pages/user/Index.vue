<template>
  <v-card width="85%" class="mx-auto p-4">
    <v-card-title>
      Users
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-btn :to="{ name: 'users.create'}" class="mx-2 d-none d-md-flex d-lg-flex d-xl-flex" dark color="primary" right style="text-decoration: none;">
        <v-icon dark>mdi-plus</v-icon>
      </v-btn>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="users"
      :search="search"
    ></v-data-table>
  </v-card>
</template>

<script>
  export default {
    data () {
      return {
        search: '',
        headers: [
          {
            text: 'ID',
            align: 'start',
            sortable: true,
            value: 'id',
          },
          { text: 'Name', value: 'name' },
          { text: 'Email', value: 'email' },

        ],
        users: [],
      }
    },

     mounted() {
      this.getUsers()
    },

    methods: {
      getUsers() {
        axios.get('users')
          .then((res) => {
            this.users = res.data
          }, () => {
            console.log("error")
          })
      }
    }
  }
</script>
