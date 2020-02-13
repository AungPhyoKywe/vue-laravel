<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-info bg-info">
            <a class="navbar-brand">Vue JS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </nav>

        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'create' }">Create</router-link>
<!--            <router-link :to="{ name: 'edit' }">Edit</router-link>-->
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
