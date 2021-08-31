<template>
  <v-card class="mx-auto" min-width="300" width="1000" outlined>
    <v-card-title>
      Study Materials
      <v-spacer></v-spacer>
      <v-btn v-if="role == '6'" :to="{ name: 'materials.create'}" class="mx-2" fab dark small color="black" right>
        <v-icon dark>mdi-clipboard-plus</v-icon>
      </v-btn>
    </v-card-title>
    <v-data-table :headers="headers"
                  :items="materials"
                  class="elevation-1">
      <template v-slot:item.options="props">

                    <v-btn :to="{ name: 'materials.edit', params: { id: props.item.id }}" class="mx-2" fab dark small color="pink">
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
          { text: 'Description', value: 'description' },
          { text: 'Classroom', value: 'materials_get_classrooms.title' },
          { text: 'Batch', value: 'materials_get_batches.title' },
          { text: 'Teacher', value: 'materials_get_teachers.name' },
          { text: 'Subject', value: 'materials_get_subjects.title' },
          { text: 'Options', value: 'options' }
        ],
        materials: [],
        submissions: [],
        role:'',
      }
    },

    mounted() {
      this.getMaterials();
      this.getUserRole();
    },

    methods: {
      getUserRole() {
        axios.get('getUserRole').then(response => {
          this.role = response.data
        })
      },
      getMaterials() {
        this.axios
          .get('study-materials')
          .then(response => {
            console.log(response.data)
            this.materials = response.data
          })
          .catch(error => {
            console.log(error)
          })
      }
    }
  }
</script>
