<template>
  <v-card class="mx-auto p-4" width="85%" raised>
    <v-card-title>
      Create User
      <v-spacer></v-spacer>
      <v-btn :to="{ name: 'users.index'}" class="mx-2" dark color="primary" right style="text-decoration: none;">
        <v-icon dark>mdi-keyboard-backspace</v-icon>
      </v-btn>
    </v-card-title>
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-text-field v-model="user.name" label="Name" required></v-text-field>
      <v-text-field
        v-model="user.roll_no"
        label="Roll No."
        required
      ></v-text-field>
      <v-text-field v-model="user.email" label="Email" required></v-text-field>
      <v-text-field
        v-model="user.password"
        autocomplete="current-password"
        :value="userPassword"
        label="Enter password"
        :append-icon="value ? 'mdi-eye' : 'mdi-eye-off'"
        @click:append="() => (value = !value)"
        :type="value ? 'password' : 'text'"
        @input="_ => (userPassword = _)"
      ></v-text-field>
      <br>
      <v-select
        :items="roles"
        item-text="title"
        item-value="id"
        label="Roles"
        v-model="user.role_id"
        v-on:change="getClassrooms"
        dense
      ></v-select>
      <br v-if="user.role_id == 7">
        <v-select
          v-if="user.role_id == 7"
          :items="departments"
          item-text="title"
          item-value="id"
          label="Select Department for Student"
          v-model="user.department_id"
          v-on:change="onChangeGetClassroom"
          dense
        >
        </v-select>
        <br v-if="user.role_id == 7 && user.department_id != ''">
        <v-select
          v-if="user.role_id == 7 && user.department_id != ''"
          :items="classrooms"
          item-text="title"
          item-value="id"
          label="Select Classroom for Student"
          v-model="user.classroom_id"
          v-on:change="onChangeGetBatch"
          dense
        >
        </v-select>
        <br v-if="user.role_id == 7 && user.classroom_id != ''">
        <v-select
          v-if="user.role_id == 7 && user.classroom_id != ''"
          :items="batches"
          item-text="title"
          item-value="id"
          label="Select Batch for Student"
          v-model="user.batch_id"
          dense
        >
        </v-select>
        <br>
      <v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">
        Update
      </v-btn>
    </v-form>
  </v-card>
</template>


<script>
  export default {
    data: () => ({
      valid: true,
      user: {
        name: '',
        email: '',
        password: '',
        roll_no: '',
        role_id: '',
        classroom_id: '',
        batch_id: '',
        department_id:'',
      },
      userPassword: '',
      value: true,
      roles: [],
      batches: [],
      classrooms: [],
      departments:[],
    }),

    mounted() {
      this.getRoles()
      this.getDepartments()
    },

    methods: {
      getDepartments(){
        this.axios.get(`departments`)
        .then(response => {
          this.departments = response.data;
        })
        .catch(error => {
          console.log(error);
        })
      },
      onChangeGetClassroom(){
        this.axios.get(`departments/${this.user.department_id}/classrooms`)
        .then(response => {
          this.classrooms = response.data;
        })
        .catch(error => {
          console.log(error)
        })
      },
      onChangeGetBatch() {
        this.axios.get(`classrooms/${this.user.classroom_id}/batches`)
        .then(response => {
          this.batches = response.data
        })
        .catch(error => {
          console.log(error)
        })
      },
      getClassrooms() {
        this.axios.get('classrooms')
        .then(response => {
          this.classrooms = response.data
        })
        .catch(error => {
          console.log(error)
        })
      },
      getRoles() {
        this.axios.get('roles')
        .then(response => {
          this.roles = response.data
        })
        .catch(error => {
          console.log('error')
        })
      },
      submit() {
        this.errors = {}
        axios.post('/users/store', this.user)
        .then(response => {
          this.$router.push('/users')
        })
        .catch(error => {
          console.log('error')
        })
      },
    }
  }
</script>
