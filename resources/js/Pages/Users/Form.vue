<template>
  <div class="w-full font-bold text-xl p-5 text-center">
    Create New User
  </div>
  <hr>
  <div class="grid grid-cols-1 gap-4 p-5 px-24">
    <div>
      <jet-label
        for="full_name"
        class="font-bold"
      >
        Full Name <span class="text-red-500">*</span>
      </jet-label>
      <jet-input
        id="full_name"
        type="text"
        class="mt-1 block w-full focus:border-transparent focus:ring-2 focus:ring-gray-400"
        autofocus
        v-model="form.full_name"
      />
      <jet-input-error
        v-if="$page.props.errors.errorBagUser"
        :message="$page.props.errors.errorBagUser.full_name"
        class="mt-2"
      />
    </div>
    <div>
      <jet-label
        for="email"
        class="font-bold"
      >
        Email <span class="text-red-500">*</span>
      </jet-label>
      <jet-input
        id="email"
        type="email"
        class="mt-1 block w-full focus:border-transparent focus:ring-2 focus:ring-gray-400"
        autofocus
        v-model="form.email"
      />
      <jet-input-error
        v-if="$page.props.errors.errorBagUser"
        :message="$page.props.errors.errorBagUser.email"
        class="mt-2"
      />
    </div>
    <div v-if="action !== 'edit'">
      <jet-label
        for="password"
        class="font-bold"
      >
        Password <span class="text-red-500">*</span>
      </jet-label>
      <jet-input
        id="password"
        type="password"
        class="mt-1 block w-full focus:border-transparent focus:ring-2 focus:ring-gray-400"
        autofocus
        v-model="form.password"
      />
      <jet-input-error
        v-if="$page.props.errors.errorBagUser"
        :message="$page.props.errors.errorBagUser.password"
        class="mt-2"
      />
    </div>
    <div v-if="action !== 'edit'">
      <jet-label
        for="
      password_confirmation"
        class="font-bold"
      >
        Password Confirmation
      </jet-label>
      <jet-input
        id="password_confirmation"
        type="password"
        class="mt-1 block w-full focus:border-transparent focus:ring-2 focus:ring-gray-400"
        autofocus
        v-model="form.password_confirmation"
      />
      <jet-input-error
        v-if="$page.props.errors.errorBagUser"
        :message="$page.props.errors.errorBagUser.password_confirmation"
        class="mt-2"
      />
    </div>
    <div>
      <jet-label
        for="role"
        class="font-bold"
      >
        Assign Role <span class="text-red-500">*</span>
      </jet-label>
      <select
        name="role"
        id="role"
        v-model="form.role_id"
        class="border-gray-300 focus:border-indigo-300 rounded-md shadow-sm mt-1 block w-full focus:border-transparent focus:ring-2 focus:ring-gray-400"
      >
        <option
          v-for="(role, index) in roleLists"
          :key="index"
          :value="role.id"
        >{{role.role_name}}</option>
      </select>
      <jet-input-error
        v-if="$page.props.errors.errorBagUser"
        :message="$page.props.errors.errorBagUser.role_id"
        class="mt-2"
      />
    </div>
  </div>
  <hr>
  <div class="p-5 px-24">
    <button
      @click="submit"
      class="uppercase bg-green-400 py-2 px-10 rounded-md text-white font-bold"
    >
      {{ action === 'edit' ? 'Update' : 'Create' }}
    </button>
    <button
      @click="closeForm"
      class="uppercase bg-gray-400 py-2 px-10 rounded-md text-white font-bold float-right"
    >
      Cancel
    </button>
  </div>
</template>

<script>
export default {
  props: ['userForm', 'action'],
  data() {
    return {
      form: {
        full_name: '',
        email: '',
        role_id: '',
      },
      roleLists: [],
    };
  },
  mounted() {
    this.form = {
      full_name: this.userForm.full_name,
      email: this.userForm.email,
      role_id: this.userForm.role_id,
    };
    if (this.action === 'edit') this.form.id = this.userForm.id;
    this.getRoles();
  },
  methods: {
    closeForm() {
      this.$emit('closeForm');
    },
    async getRoles() {
      await axios.get(this.route("role.getRoles"))
        .then((res) => {
          this.roleLists = res.data;
        })
    },
    errorBags(val) {
      console.log(val);
    },
    submit() {
      if (this.action === 'edit') {
        this.$inertia.post(route('user.updateUser'), this.form, {
          preserveScroll: true,
          errorBag: 'errorBagUser',
          onSuccess: () => (
            this.$emit('success')
          ),
        });
      } else {
        this.$inertia.post(route('user.createUser'), this.form, {
          preserveScroll: true,
          errorBag: 'errorBagUser',
          onSuccess: () => (
            this.$emit('success')
          ),
        });
      }
    },
  }
}
</script>

<style>
</style>