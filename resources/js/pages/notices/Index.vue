<template>
  <v-card class="mx-auto" min-width="300" width="1000" outlined>
    <v-card-title>
      Notices
      <v-spacer></v-spacer>
      <v-btn v-if="role == '6'" :to="{ name: 'notices.create'}" class="mx-2" fab dark small color="black" right>
        <v-icon dark>mdi-clipboard-plus</v-icon>
      </v-btn>
    </v-card-title>
    <v-data-table :headers="headers"
                  :items="notices"
                  class="elevation-1">
      <template v-slot:item.options="props">
                    <v-btn :to="{ name: 'notices.view', params: { id: props.item.id }}" class="mx-2" fab dark small color="pink">
                      <v-icon dark>mdi-eye</v-icon>
                    </v-btn>
                    <v-btn v-if="role == '6'" :to="{ name: 'notices.edit', params: { id: props.item.id }}" class="mx-2" fab dark small color="pink">
                      <v-icon dark>mdi-pencil</v-icon>
                    </v-btn>

                  </template>
    </v-data-table>
  </v-card>
</template>

<script>
  export default {
    data() {
      return {
        headers: [
          {
            text: 'ID',
            align: 'start',
            sortable: true,
            value: 'id'
          },
          { text: 'Title', value: 'title' },
          { text: 'Notice_Text', value: 'notice_text' },
          { text: 'Teacher', value: 'notices_get_teachers.name' },
          { text: 'Options', value: 'options' }
        ],
        notices: [],
        submissions: [],
        role: ''
      }
    },

    mounted() {
      this.getNotices()
      this.getUserRole()
    },

    methods: {
      getUserRole() {
        axios.get('getUserRole').then(response => {
          this.role = response.data
        })
      },
      getNotices() {
        this.axios
          .get('notices')
          .then(response => {
            this.notices = response.data
          })
          .catch(error => {
            console.log(error)
          })
      }
    }
  }
</script>
