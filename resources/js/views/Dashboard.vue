<template>
	<v-container fluid>
		<v-card class="mb-3">
			<v-card-title>{{ $t('Dashboard') }}</v-card-title>
		</v-card>
	</v-container>
</template>

<script>
import constants from '../constants'
export default {
    data: () => ({
        storagePath: constants.storagePath,
        loading: true,
    }),

    mounted(){

    },
    methods: {
    }
}
</script>
