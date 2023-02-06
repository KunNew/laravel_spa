<template>
    <v-container fluid>
        <v-card class="mb-3">
            <template v-if="loading">
                <v-skeleton-loader type="card-heading"></v-skeleton-loader>
                <v-skeleton-loader class="px-4 pb-3" type="text"></v-skeleton-loader>
            </template>
            <template v-else>
                <v-card-title>role</v-card-title>
                <v-card-subtitle>Role/edit</v-card-subtitle>
            </template>
        </v-card>
        <v-form lazy-validation ref="form" @submit.prevent="onSubmit" :disabled="form.submitting">
            <v-card>
                <v-card-subtitle>
                    <v-btn class="ma-1" outlined color="primary" @click="$router.go(-1)"><v-icon left>mdi-arrow-left</v-icon>{{ $t('Back') }}</v-btn>
                </v-card-subtitle>
                <v-card-subtitle class="mb-3">Fill the form bellow to create edit permission</v-card-subtitle>
                <v-card-text>
                    <v-row>

                        <v-col class="py-0" cols="12">
                            <v-text-field
                                v-model="form.data.name"
                                required
                                :rules="[v => !!v || 'Name is required']"
                                outlined
                                label="Name">
                            </v-text-field>
                        </v-col>
                        <v-col
                            class="py-0"
                            cols="12"
                            sm="6"
                            md="4"
                            v-for="(it, index) in permissions"
                            :key="index"
                        >
                            <v-checkbox
                                v-model="form.data.permissions"
                                :label="it.name"

                                :value="it.id"
                            ></v-checkbox>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions class="px-4 pb-4">
                    <v-btn type="submit" color="success" :loading="form.submitting"><v-icon left>mdi-checkbox-marked-circle-outline</v-icon>Save</v-btn>
                    <v-btn color="secondary"><v-icon left>mdi-cancel</v-icon>Cancel</v-btn>
                </v-card-actions>
            </v-card>
        </v-form>
    </v-container>
</template>
<script>
import constants from '../../constants'
import axiosApiInstance from '../../utilites'
export default {
    data: () => ({
        loading: true,
        current_date: null,
        constants: constants,
        form: {
            model: {},
            submitting: false,
            data: {
                name: null,
                permissions: []
            },
        },
        permissions: []
    }),

    mounted()
    {
        this.fetchData()
        this.fetchPermission()
    },
    computed: {

    },

    methods:
    {
        fetchPermission() {
            axiosApiInstance
                .get(`permission`)
                .then((response) => {
                    // console.log(response.data);
                    this.permissions = response.data?.data;
                })
                .catch((response) => {
                    this.$store.dispatch("pushNotification", {
                        message: response.data.message,
                        type: "error",
                    });
                });
        },
        fetchData()
        {
            axiosApiInstance.get(`role/${ this.$route.params.role }/edit`)
            .then(response => {
                this.form = response.data
                // console.log(response.data);
            })
            .catch(({ response }) => {
                this.$store.dispatch('pushNotification', { message: response.data.message, type: 'error' })
            })
            .finally(() => {
                this.loading = false
            })
        },
        onInputFile(e)
        {
            if (e) this.form.additional.avatar = URL.createObjectURL(e)
            else this.form.additional.avatar = null
        },

        onSubmit()
        {
            if (this.$refs.form.validate())
            {
                this.form.submitting = true
                axiosApiInstance.put(`role/${ this.$route.params.role }`, this.form.data)
                .then(response => {
                    this.$store.dispatch('pushNotification', { message: response.data.message, type: 'success' })
                    this.$router.go(-1)
                })
                .catch(({ response }) => {
                    this.$store.dispatch('pushNotification', { message: response.data.message, type: 'error' })
                })
                .finally(() => {
                    this.form.submitting = false
                })
            }
        }

        // keyDown(e)
        // {
        //     var charCode = e.keyCode
        //     console.log(e)
        //     if (charCode < 8 || charCode > 9 && charCode < 16 || charCode > 20 && charCode < 33 || charCode > 40 && charCode < 45 || charCode == 47 || charCode > 57 && charCode < 61 || charCode > 61 && charCode < 91 || charCode > 91) e.preventDefault();
        // }
    }

}
</script>
