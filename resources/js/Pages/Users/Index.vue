<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>
    <!-- <Messages
    v-if="flash.message && !flash.error"
    :flash="flash"
  /> -->

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

          <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="grid grid-cols-1 gap-4 w-full p-5">
              <div class="text-right">
                <button
                  @click="createUser"
                  class="uppercase bg-green-400 py-2 px-10 rounded-md text-white font-bold"
                >
                  Create New
                </button>
              </div>
              <div class="w-full">

                <table class="w-full border border-green-400">
                  <thead class="bg-green-400">
                    <th>#</th>
                    <th>Full Name</th>
                    <th>email</th>
                    <th>Role</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center hover:bg-gray-200 border border-green-400"
                      v-for="(user, index) in userLists"
                      :key="index"
                    >
                      <td class="p-2">{{user.id}}</td>
                      <td>{{user.full_name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.role.role_name}}</td>
                      <td>
                        <svg
                          @click="viewUser(user)"
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-6 w-6 inline text-gray-600"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                          />
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                          />
                        </svg>
                        <svg
                          @click="editUser(user)"
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-6 w-6 inline text-gray-600"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                          />
                        </svg>
                        <svg
                          @click="deleteUser(user)"
                          xmlns="http://www.w3.org/2000/svg"
                          class="h-6 w-6 inline text-gray-600"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                          />
                        </svg>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <modal
              :show="showForm"
              @close="closeForm"
              maxWidth="xl"
            >
              <Forms
                :userForm="userForm"
                :action="action"
                @success="success"
                @closeForm="closeForm"
              />
            </modal>
            <modal
              :show="showUser"
              @close="closeUser"
              maxWidth="xl"
            >
              <div class="text-center">
                <div class="p-5 w-full font-bold text-center text-xl">
                  User Details View
                </div>
                <hr>
                <div class="p-5">
                  <table>
                    <tr>
                      <td class="text-left p-2">Full Name:</td>
                      <td class="text-left pl-5">{{activeUser.full_name}}</td>
                    </tr>
                    <tr>
                      <td class="text-left p-2">Email:</td>
                      <td class="text-left pl-5">{{activeUser.email}}</td>
                    </tr>
                    <tr>
                      <td class="text-left p-2">Role:</td>
                      <td class="text-left pl-5">{{activeUser.role.role_name}}</td>
                    </tr>
                  </table>
                </div>

                <hr>
                <div class="w-full text-left p-5">
                  <button
                    @click="showUser = false;editUser(activeUser);"
                    class="uppercase bg-green-400 py-2 px-10 rounded-md text-white font-bold"
                  >
                    Edit
                  </button>
                  <button
                    @click="closeUser"
                    class="uppercase bg-gray-400 py-2 px-10 rounded-md text-white font-bold float-right"
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </modal>
            <modal
              :show="showDelete"
              @close="closeDelete"
              maxWidth="xl"
            >
              <div class="p-5 text-center text-xl font-bold w-full">
                Delete {{activeUser.full_name}} User
              </div>
              <hr>
              <div class="p-5">
                Are you sure? You want to delete this role ?
              </div>
              <hr>
              <div class="p-5 w-full">
                <button
                  @click="userDelete"
                  class="uppercase bg-green-400 py-2 px-10 rounded-md text-white font-bold"
                >
                  Confirm
                </button>
                <button
                  @click="closeDelete"
                  class="uppercase bg-gray-400 py-2 px-10 rounded-md text-white font-bold float-right"
                >
                  Cancel
                </button>
              </div>

            </modal>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import Forms from './Form.vue';

export default {
  props: ['roles'],
  components: {
    AppLayout,
    Forms,
    // Messages
  },

  data() {
    return {
      showForm: false,
      showDelete: false,
      showUser: false,
      activeUser: {},
      userForm: {
        full_name: '',
        email: '',
        role: '',
      },
      action: 'create',
      userLists: [],
    };
  },
  mounted() {
    this.getUsers();
    // console.log(this.users);
  },
  methods: {
    async getUsers() {
      await axios.get(this.route("user.getUsers"))
        .then((res) => {
          this.userLists = res.data;
        })
    },
    success() {
      this.getUsers();
      this.showForm = false;
    },
    viewUser(val) {
      this.activeUser = val;
      this.showUser = true;
    },
    createUser() {
      this.action = 'create';
      this.userForm = {
        full_name: '',
        email: '',
      }
      this.showForm = true;
    },
    editUser(val) {
      this.userForm = val;
      this.action = 'edit';
      this.showForm = true;

    },
    deleteUser(val) {
      this.activeUser = val;
      this.showDelete = true;
    },
    finishDelete() {
      this.getUsers();
      this.showDelete = false;
    },
    userDelete() {
      this.$inertia.post(route('user.deleteUser'), this.activeUser, {
        preserveScroll: true,
        onSuccess: () => (
          this.finishDelete()
        ),
      });
    },
    closeDelete() {
      this.showDelete = false;
    },
    closeUser() {
      this.showUser = false;
    },
    closeForm() {
      this.showForm = false;
    },
  }
}
</script>

<style>
</style>