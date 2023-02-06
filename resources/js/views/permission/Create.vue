<template>
    <v-container fluid>
        <v-card class="mb-3">
            <template v-if="loading">
                <v-skeleton-loader type="card-heading"></v-skeleton-loader>
                <v-skeleton-loader
                    class="px-4 pb-3"
                    type="text"
                ></v-skeleton-loader>
            </template>
            <template v-else>
                <v-card-title>permission</v-card-title>
                <v-card-subtitle>Permission/create.</v-card-subtitle>
            </template>
        </v-card>
        <v-form
            lazy-validation
            ref="form"
            @submit.prevent="onSubmit"
            :disabled="form.submitting"
        >
            <v-card>
                <v-card-subtitle>
                    <v-btn
                        class="ma-1"
                        outlined
                        color="primary"
                        @click="$router.go(-1)"
                        ><v-icon left>mdi-arrow-left</v-icon
                        >{{ $t("Back") }}</v-btn
                    >
                </v-card-subtitle>
                <v-card-subtitle class="mb-3"
                    >Fill the form bellow to create new
                    permission</v-card-subtitle
                >
                <v-card-text>
                    <v-row>
                        <v-col class="py-0" cols="12">
                            <v-text-field
                                v-model="form.data.name"
                                type="email"
                                required
                                :rules="[(v) => !!v || 'Name is required']"
                                outlined
                                label="Name"
                            >
                            </v-text-field>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions class="px-4 pb-4">
                    <v-btn
                        type="submit"
                        color="success"
                        :loading="form.submitting"
                        ><v-icon left>mdi-checkbox-marked-circle-outline</v-icon
                        >Save</v-btn
                    >
                    <v-btn color="secondary"
                        ><v-icon left>mdi-cancel</v-icon>Cancel</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-form>
    </v-container>
</template>
<script>
import axiosApiInstance from "../../utilites";
export default {
    data: () => ({
        loading: true,
        current_date: null,
        form: {
            submitting: false,
            data: {
                name: null,
            },
        },
    }),

    mounted() {
        this.loading = false;
    },

    methods: {

        onSubmit() {
            if (this.$refs.form.validate()) {
                this.form.submitting = true;

                axiosApiInstance
                    .post("permission", this.form.data)
                    .then((response) => {
                        this.$store.dispatch("pushNotification", {
                            message: response.data.message,
                            type: "success",
                        });
                        this.$router.go(-1);
                    })
                    .catch(({ response }) => {
                        this.$store.dispatch("pushNotification", {
                            message: response.data.message,
                            type: "error",
                        });
                    })
                    .finally(() => {
                        this.form.submitting = false;
                    });
            }
        },

        // keyDown(e)
        // {
        //     var charCode = e.keyCode
        //     console.log(e)
        //     if (charCode < 8 || charCode > 9 && charCode < 16 || charCode > 20 && charCode < 33 || charCode > 40 && charCode < 45 || charCode == 47 || charCode > 57 && charCode < 61 || charCode > 61 && charCode < 91 || charCode > 91) e.preventDefault();
        // }
    },
};
</script>
