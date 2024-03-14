<template>
  <div class="container py-4 bg-dark">
    <div class="row">
      <div class="col-lg-7">
        <table class="table">
          <thead class="text-dark bg-white">
            <th>#</th>
            <th>Fname</th>
            <th>Lname</th>
            <th>Phone</th>
            <th>Manger</th>
          </thead>
          <tbody>
            <tr v-for="(student, index) in students" :key="index">
              <td>{{ index }}</td>
              <td>{{ student.fname }}</td>
              <td>{{ student.lname }}</td>
              <td>{{ student.phone }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-warning" @click="editStudent(student.id)">แก้ไข</button>
                <button type="button" class="btn btn-sm btn-danger" @click="deleteStudent(student.id)">ลบ</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            {{ formData }}
            <form @submit.prevent="handleSubmit">
              <div class="mb-3">
                <label for="">Fname</label>
                <input type="text" class="form-control" v-model="formData.fname">
              </div>
              <div class="mb-3">
                <label for="">Lname</label>
                <input type="text" class="form-control" v-model="formData.lname">
              </div>
              <div class="mb-3">
                <label for="">Phone</label>
                <input type="number" class="form-control" v-model="formData.phone">
              </div>
              <button type="submit" class="btn btn-success w-100" v-if="!editMode">OK</button>
              <button type="button" class="btn btn-success w-100" v-else @click="updateStudent">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "axios"

const formData = ref({
  fname: '',
  lname: '',
  phone: ''
})

const students = ref({})
const editMode = ref(false)

const handleSubmit = async () => {
  try {
    const res = await axios.post("http://127.0.0.1:8000/api/students", formData.value)
    await getStudents()
  } catch (e) {
    console.log(e);
  } finally {

  }
}

const getStudents = async () => {
  try {
    const res = await axios.get("http://127.0.0.1:8000/api/students")
    students.value = res.data.data


  } catch (e) {
    console.log(e);
  }
}

const editStudent = async (id) => {
  try {
    editMode.value = true
    const res = await axios.get("http://127.0.0.1:8000/api/students/" + id)
    formData.value = res.data.data
  } catch (e) {
    console.log(e);
  }
}

const updateStudent = async () => {
  try {
    const res = await axios.post('http://127.0.0.1:8000/api/students/' + formData.value.id + '/update', formData.value)
    await getStudents()
  } catch (e) {
    console.log(e);
  }
}

const deleteStudent = async (id) => {
  try {
    const res = await axios.delete("http://127.0.0.1:8000/api/students/" + id + "/delete");
    await getStudents()
  } catch (e) {
    console.log(e);
  }
}



onMounted(() => {
  getStudents()
})
</script>

<style scoped></style>