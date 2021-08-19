<template>
  <div class="grid grid-cols-1 gap-4 p-5 px-24">
    <div>

      <jet-label
        for="role_name"
        class="font-bold"
      >

        Role Name <span class="text-red-500">*</span>
      </jet-label>
      <jet-input
        id="role_name"
        type="text"
        class="mt-1 block w-full focus:border-transparent focus:ring-2 focus:ring-gray-400"
        autofocus
        v-model="form.role_name"
      />
      <jet-input-error
        v-if="$page.props.errors.errorBagRole"
        :message="$page.props.errors.errorBagRole.role_name"
        class="mt-2"
      />

    </div>
    <div>

      <jet-label
        for="description"
        value="Description"
        class="font-bold"
      />
      <jet-input
        id="description"
        type="text"
        class="mt-1 block w-full focus:border-transparent focus:ring-2 focus:ring-gray-400"
        autofocus
        v-model="form.description"
      />

    </div>
    <div>
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
  </div>
</template>

<script>
export default {
  props: ['roleForm', 'action'],
  data() {
    return {
      form: {
        role_name: '',
        description: '',
      }
    };
  },
  mounted() {
    this.form = {
      id: this.roleForm.id,
      role_name: this.roleForm.role_name,
      description: this.roleForm.description
    };
    console.log(this.form);
  },
  methods: {
    closeForm() {
      this.$emit('closeForm');
    },
    errorBags(val) {
      console.log(val);
    },
    submit() {
      if (this.action === 'edit') {
        this.$inertia.post(route('role.updateRole'), this.form, {
          preserveScroll: true,
          errorBag: 'errorBagRole',
          onSuccess: () => (
            this.$emit('success')
          ),
        });
      } else {
        this.$inertia.post(route('role.createRole'), this.form, {
          preserveScroll: true,
          errorBag: 'errorBagRole',
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