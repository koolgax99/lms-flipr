<template>
  <v-data-table
    :headers="headers"
    :items="subjects"
    class="elevation-1"
  ></v-data-table>
</template>

<script>
  export default {
    data () {
      return {
        headers: [
          {
            text: 'ID',
            align: 'start',
            sortable: true,
            value: 'id',
          },
          { text: 'Title', value: 'title' },
          { text: 'Description', value: 'description' },
          { text: 'Code', value: 'description' },
          { text: 'Semester', value: 'description' },
          { text: 'lecture_hours_per_week', value: 'lecture_hours_per_week' },
          { text: 'tutorial_hours_per_week', value: 'tutorial_hours_per_week' },
          { text: 'practical_hours_per_week', value: 'practical_hours_per_week' },
          { text: 'ss_hours_per_week', value: 'ss_hours_per_week' },
          { text: 'Credits', value: 'credits' },


        ],
        subjects: []

      }
    },

     mounted() {
      this.getSubjects()
    },

    methods: {
      getSubjects() {
        axios.get('subjects')
          .then((res) => {
            console.log(res.data);
            this.subjects = res.data
          }, () => {
            console.log("error")
          })
      }
    }
  }
</script>