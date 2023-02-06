<template>
    <v-container fluid>
      <v-card class="mb-3">
        <v-card-title>Setting</v-card-title>
        <v-card-subtitle>View and manage setting</v-card-subtitle>
      </v-card>

      <!-- <v-card class="mb-4">
        <v-card-title>
            <v-card-title>
                {{ user.full_name }}
            </v-card-title>
        </v-card-title>
      </v-card> -->
      <v-card>
        <v-tabs fixed-tabs>
          <v-tab>
            <v-icon left>mdi-account</v-icon>
            Profile
          </v-tab>
          <v-tab>
            <v-icon left>mdi-account</v-icon>
            Change password
          </v-tab>
          <v-tab-item>
            <v-form
              @submit.prevent="updateProfile"
              ref="formProfile"
              lazy-validation
              :disabled="formProfile.submitting"
            >
              <v-card flat>
                <v-card-text>
                  <v-row>
                    <v-col cols="12">
                      <!-- <input-image-crop
                        v-model="formProfile.data.avatar"
                        label="Avatar">
                      </input-image-crop> -->
                    </v-col>
                    <v-col cols="12" class="py-0">
                      <v-text-field
                        autocomplete="off"
                        label="Last Name"
                        name="last_name"
                        v-model="formProfile.data.last_name"
                        required
                        :rules="[(v) => !!v || 'Last Name is required']"
                        outlined
                      >
                      </v-text-field>
                    </v-col>
                    <v-col cols="12" class="py-0">
                      <v-text-field
                        autocomplete="off"
                        label="First Name"
                        name="first_name"
                        v-model="formProfile.data.first_name"
                        required
                        :rules="[(v) => !!v || 'First Name is required']"
                        outlined
                      >
                      </v-text-field>
                    </v-col>
                    <v-col cols="12" class="py-0">
                      <v-text-field
                        autocomplete="off"
                        label="Username"
                        name="username"
                        v-model="formProfile.data.username"
                        required
                        :rules="[(v) => !!v || 'Username is required']"
                        outlined
                      >
                      </v-text-field>
                    </v-col>
                    <v-col cols="12" class="py-0">
                      <v-text-field
                        autocomplete="off"
                        label="Email"
                        name="email"
                        v-model="formProfile.data.email"
                        prepend-inner-icon="mdi-email"
                        type="email"
                        required
                        :rules="[(v) => !!v || 'Email is requred']"
                        outlined
                      >
                      </v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-btn
                        type="submit"
                        :loading="formProfile.submitting"
                        color="success"
                        >Save</v-btn
                      >
                    </v-col>
                  </v-row>
                </v-card-text>
              </v-card>
            </v-form>
          </v-tab-item>
          <v-tab-item>
            <v-card flat>
              <v-card-text>
                <v-form
                  @submit.prevent="changePassword"
                  lazy-validation
                  ref="formPassword"
                  :disabled="formPassword.submitting"
                >
                  <v-row>
                    <v-col cols="12" class="py-0">
                      <v-text-field
                        v-model="formPassword.data.old_password"
                        autocomplete="off"
                        label="Old Passwrod"
                        prepend-inner-icon="mdi-lock"
                        required
                        :rules="[(v) => !!v || 'Old password is requred']"
                        type="password"
                        outlined
                      >
                      </v-text-field>
                    </v-col>
                    <v-col cols="12" class="py-0">
                      <v-text-field
                        v-model="formPassword.data.password"
                        autocomplete="off"
                        label="New Password"
                        prepend-inner-icon="mdi-lock"
                        required
                        :rules="[
                          (v) => !!v || 'New password',
                          (v) =>
                            (v && v.length >= 8) || 'Password must be at least 8',
                        ]"
                        type="password"
                        outlined
                      >
                      </v-text-field>
                    </v-col>
                    <v-col cols="12" class="py-0">
                      <v-text-field
                        v-model="formPassword.data.confirm_password"
                        autocomplete="off"
                        label="Confirm Password"
                        prepend-inner-icon="mdi-lock"
                        required
                        :rules="confirmPasswordRule"
                        type="password"
                        outlined
                      >
                      </v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-btn
                        type="submit"
                        ref="btn_change_password"
                        :loading="formPassword.submitting"
                        color="success"
                        >Save</v-btn
                      >
                    </v-col>
                  </v-row>
                </v-form>
              </v-card-text>
            </v-card>
          </v-tab-item>
        </v-tabs>
      </v-card>
    </v-container>
  </template>

  <script>
  import { mapGetters } from 'vuex'
  import axiosApiInstance from '../utilites'
  export default {
    data: () => ({
      dialog: null,
      tab: null,

      formProfile: {
        submitting: false,
        data: {
          avatar: {
            src: '',
            file: null,
          },
          first_name: '',
          last_name: '',
          username: '',
          email: '',
        },
      },

      formPassword: {
        submitting: false,
        data: {
          old_password: '',
          password: '',
          confirm_password: '',
        },
      },
    }),

    computed: {
      ...mapGetters('auth', {
        user: 'user',
      }),

      confirmPasswordRule() {
        return [
          (v) => !!v || 'Confirm Password',
          () =>
            this.formPassword.data.password ==
              this.formPassword.data.confirm_password ||
            'Password does not match',
        ]
      },
    },

    mounted() {
      this.fetchProfile()
    },

    methods: {
      fetchProfile() {
        axiosApiInstance.get('auth/user').then((response) => {
          // console.log(response.data)
          this.initFormProfile(response)
        })
      },

      initFormProfile(response) {
        this.formProfile.data = {
          avatar: {
            src: response.data.avatar,
            file: '',
          },
          id: response.data.id,
          first_name: response.data.first_name,
          last_name: response.data.last_name,
          username: response.data.username,
          email: response.data.email,
        }
      },

      updateProfile() {
        if (this.$refs.formProfile.validate()) {
          this.formProfile.submitting = true
          let formData = new FormData()

          formData.append('first_name', this.formProfile.data.first_name)
          formData.append('last_name', this.formProfile.data.last_name)
          formData.append('username', this.formProfile.data.username)
          formData.append('email', this.formProfile.data.email)
          formData.append('_method', 'PUT')
          if (this.formProfile.data.avatar.src)
            formData.append('avatar[src]', this.formProfile.data.avatar.src)
          if (this.formProfile.data.avatar.file)
            formData.append('avatar[file]', this.formProfile.data.avatar.file)
          axiosApiInstance
            .post(
              `setting/change_profile/${this.formProfile.data.id}`,
              formData,
              {
                headers: { 'content-type': 'multipart/form-data' },
              }
            )
            .then((response) => {
              // this.$notify({group: 'alert', type: 'success', title: 'Success', text: response.data.message})
              this.$store.dispatch('pushNotification', {
                message: response.data.message,
                type: 'success',
              })
              this.fetchProfile()
              this.$store.dispatch('auth/getUser').catch(() => {})
            })
            .catch(({ response }) => {
              // this.$notify({group: 'alert', type: 'error', title: 'Error', text: response.data.message || 'Cannot connect to the remote server.' })
              this.$store.dispatch('pushNotification', {
                message:
                  response.data.message || 'Cannot connect to the remote server.',
                type: 'error',
              })
            })
            .finally(() => {
              this.formProfile.submitting = false
            })
        }
      },

      changePassword() {
        if (this.$refs.formPassword.validate()) {
          this.$refs.btn_change_password.$el.focus()
          this.$refs.btn_change_password.$el.blur()
          this.formPassword.submitting = true
          axiosApiInstance
            .put(`setting/change_password/${this.formProfile.id}`, this.formPassword.data)
            .then((response) => {
              this.$store.dispatch('pushNotification', {
                message: response.data.message,
                type: 'success',
              })
              this.$refs.formPassword.reset()
              // this.$notify({
              //   group: 'alert',
              //   type: 'success',
              //   title: 'Success',
              //   text: response.data.message,
              // })
            })
            .catch(({ response }) => {
              // this.$notify({
              //   group: 'alert',
              //   type: 'error',
              //   title: 'Error',
              //   text:
              //     response.data.message || 'Cannot connect to the remote server.',
              // })
              this.$store.dispatch('pushNotification', {
                message:
                  response.data.message || 'Cannot connect to the remote server.',
                type: 'error',
              })
            })
            .finally(() => {
              this.formPassword.submitting = false
            })
        }
      },
    },
  }
  </script>
