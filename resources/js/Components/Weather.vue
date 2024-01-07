<script setup>
import { usePage } from "@inertiajs/vue3";

const weather = usePage().props.weather;
</script>

<template>

<div>
    <!--<p>{{ weather.name }}</p>-->
    <p>{{ weather.name }}</p>
</div>

</template>