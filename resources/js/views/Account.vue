<template>
    <div>
        <h1 class="page-title">Account</h1>
        <div class="card">
            <div class="card-body">
                <pre>
                {{ $store.state.auth.user }}
                </pre>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style>
</style>