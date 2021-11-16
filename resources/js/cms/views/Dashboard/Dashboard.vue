<template>
    <div class="p-5">
        <span class="font-bold">Dashboard</span><br>

        <router-link :to="{ name: 'CmsSignin' }" class="mt-3 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Login page
        </router-link>
    </div>
</template>

<script>
export default {
    name: "Dashboard"
}
</script>

<style scoped>

</style>
