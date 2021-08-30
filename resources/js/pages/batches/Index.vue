<template>
  <v-data-table
    :headers="headers"
    :items="batches"
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

        ],
        batches: []

      }
    },

     mounted() {
      this.getBatches()
    },

    methods: {
      getBatches() {
        axios.get('batches')
          .then((res) => {
            console.log(res.data);
            this.batches = res.data
          }, () => {
            console.log("error")
          })
      }
    }
  }
</script>
