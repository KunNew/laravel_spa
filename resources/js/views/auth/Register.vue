<template>
    <v-app>
        <v-main>
            <v-container class="fill-height fill_image" fluid>
                <v-row align="center" justify="center" dense>
                    <v-col cols="12" sm="8" md="4" lg="4" style="padding: 10px;">
                        <v-card elevation="0" color="#FFFFFFDD">
                            <v-card-subtitle class="text-center text-h5">Agritech</v-card-subtitle>
                            <v-divider></v-divider>
                            <v-card-text>
                                <!-- <v-img :src="`storage/logo.png`" height="150" contain></v-img><br> -->
                                <v-form>
                                <v-text-field
                                    v-model="form.username"
                                    autocomplete="off"
                                    label="Enter your email"
                                    name="email"
                                    prepend-inner-icon="mdi-email"
                                    type="email"
                                    class="rounded-0"
                                    outlined>
                                </v-text-field>
                                <v-text-field
                                    v-model="form.password"
                                    autocomplete="off"
                                    label="Enter your password"
                                    name="password"
                                    prepend-inner-icon="mdi-lock"
                                    :type="show_password ? 'text': 'password'"
                                    class="rounded-0"
                                    outlined>
                                </v-text-field>
                                <v-text-field
                                    v-model="form.password_confirmation"
                                    autocomplete="off"
                                    label="Confirm your password"
                                    name="password"
                                    prepend-inner-icon="mdi-lock"
                                    :type="show_password ? 'text': 'password'"
                                    class="rounded-0"
                                    outlined>
                                </v-text-field>
                                <v-card-actions class="text--secondary" style="margin-top: -30px;">
                                    <v-checkbox v-model="show_password" color="#000000" label="Show password"></v-checkbox>
                                </v-card-actions>
                                <v-btn class="rounded-0" color="success" x-large block dark @click="register">Create Account</v-btn>
                                <v-card-actions class="text--secondary">
                                    <v-spacer></v-spacer>
                                    <router-link :to="{ name: 'login' }" class="pl-2" style="color: #000000">Back to login</router-link>
                                </v-card-actions>
                                </v-form>
                            </v-card-text>
                            <v-card-actions class="ml-6 mr-6 text-center">
                                <p>By continuing, you agree to Yamato Green's <a href="#" class="pl-2" style="color: #000000">Policy</a> and <a href="#" class="pl-2" style="color: #000000">Terms of Use</a></p>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<style scoped>
    .fill_image {
        background-image: url('../../../../public/storage/bg.jpg');
        background-clip: content-box;
        background-size: cover;
    }
</style>

<script>
export default {
    data: () => ({
        form : {
            username: null,
            password: null,
            password_confirmation: null,
        },
        show_password: false
    }),
    methods: {
        register(){
            this.$router.push({name: 'home'})
        }
    }
}
</script>
