<template>
    <v-container fluid>
        <v-card class="mb-3">
            <template v-if="loading">
                <v-skeleton-loader type="card-heading"></v-skeleton-loader>
                <v-skeleton-loader class="px-4 pb-3" type="text"></v-skeleton-loader>
            </template>
            <template v-else>

                <v-card-subtitle>{{ $t('User Detail') }}</v-card-subtitle>
            </template>
        </v-card>
        <v-card>
            <v-card-subtitle>
                <v-btn class="ma-1" outlined color="primary" @click="$router.go(-1)"><v-icon left>mdi-arrow-left</v-icon>Back</v-btn>
                <v-btn class="ma-1" color="warning" :to="{ name: 'role.edit' }"><v-icon left>mdi-pencil-box-outline</v-icon>Edit role</v-btn>
            </v-card-subtitle>
            <v-card-text v-if="!loading">
                <v-row>
                    <v-col cols="12" md="5" lg="4" xl="3">
                        <v-card elevation="0">

                            <v-card-text>
                                <v-list-item dense>
                                    <v-list-item-icon>
                                        <v-icon>mdi-account</v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>{{ model.name }}</v-list-item-title>
                                        <v-list-item-subtitle>Role</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="7" lg="8" xl="9"></v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>
<script>
import constants from '../../constants'
import axiosApiInstance from '../../utilites'
export default {
    data: () => ({
        loading: true,
        constants: constants,
        model: {}
    }),

    mounted()
    {
        this.fetchData()
    },

    methods:
    {
        fetchData()
        {
            axiosApiInstance.get(`role/${ this.$route.params.role }`)
            .then(response => {
                this.model = response.data
            })
            .catch(({ response }) => {
                this.$store.dispatch('pushNotification', { message: response.data.message, type: 'error' })
            })
            .finally(() => {
                this.loading = false
            })
        }
    }
}
</script>
