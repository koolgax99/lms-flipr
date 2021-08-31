<template>
  <v-data-table
    :headers="headers"
    :items="holidays"
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
          { text: 'Date', value: 'date' },


        ],
        holidays: []

      }
    },

     mounted() {
      this.getHolidays()
    },

    methods: {
      getHolidays() {
        axios.get('holidays')
          .then((res) => {
            console.log(res.data);
            this.holidays = res.data
          }, () => {
            console.log("error")
          })
      }
    }
  }
</script>
