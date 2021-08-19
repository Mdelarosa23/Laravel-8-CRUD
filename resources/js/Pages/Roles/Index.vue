<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Roles
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
                  @click="createRole"
                  class="uppercase bg-green-400 py-2 px-10 rounded-md text-white font-bold"
                >
                  Create New
                </button>
              </div>
              <div class="w-full">

                <table class="w-full border border-green-400">
                  <thead class="bg-green-400">
                    <th>#</th>
                    <th>Role Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <tr
                      class="text-center hover:bg-gray-200 border border-green-400"
                      v-for="(role, index) in roleLists"
                      :key="index"
                    >
                      <td class="p-2">{{role.id}}</td>
                      <td>{{role.role_name}}</td>
                      <td>{{role.description}}</td>
                      <td>
                        <svg
                          @click="viewRole(role)"
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
                          @click="editRole(role)"
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
                          @click="deleteRole(role)"
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
                :roleForm="roleForm"
                :action="action"
                @success="success"
                @closeForm="closeForm"
              />
            </modal>
            <modal
              :show="showRole"
              @close="closeRole"
              maxWidth="xl"
            >
              <div class="p-5 text-center">
                <div class="w-full font-bold text-left">
                  Role View
                </div>
                <hr class="my-3">
                {{ activeRole.role_name }}<br>
                {{ activeRole.description }}

                <hr class="my-3">
                <div class="w-full text-left">
                  <button
                    @click="showRole = false;editRole(activeRole);"
                    class="uppercase bg-green-400 py-2 px-10 rounded-md text-white font-bold"
                  >
                    Edit
                  </button>
                  <button
                    @click="closeRole"
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

              <div class="p-5 px-24">
                Are you sure? You want to delete this role ?
                <div class="mt-5 w-full">
                  <button
                    @click="roleDelete"
                    class="uppercase bg-gray-400 py-2 px-10 rounded-md text-white font-bold"
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
  },

  data() {
    return {
      showForm: false,
      showDelete: false,
      showRole: false,
      activeRole: '',
      roleForm: {
        role_name: '',
        description: '',
      },
      action: 'create',
      roleLists: [],
    };
  },
  mounted() {
    this.getRoles();
  },
  methods: {
    async getRoles() {
      await axios.get(this.route("role.getRoles"))
        .then((res) => {
          this.roleLists = res.data;
        })
    },
    viewRole(val) {
      this.activeRole = val;
      this.showRole = true;
    },
    createRole() {
      this.action = 'create';
      this.roleForm = {
        role_name: '',
        description: '',
      }
      this.showForm = true;
    },
    editRole(val) {
      this.roleForm = val;
      this.action = 'edit';
      this.showForm = true;

    },
    closeForm() {
      this.showForm = false;
    },
    success() {
      this.getRoles();
      this.showForm = false;
    },
    deleteRole(val) {
      this.activeRole = val;
      this.showDelete = true;
    },
    finishDelete() {
      this.getRoles();
      this.showDelete = false;
    },
    roleDelete() {
      this.$inertia.post(route('role.deleteRole'), this.activeRole, {
        preserveScroll: true,
        onSuccess: () => (
          this.finishDelete()
        ),
      });
    },
    closeDelete() {
      this.showDelete = false;
    },
    closeRole() {
      this.showRole = false;
    }
  }
}
</script>

<style>
</style>