<template>
    <header class="wm-header">
        <div class="wm-header__menu"
             @click="onMenuToggle"
             :class="{ 'wm-header__menu--close': toggle }">
            <div class="wm-header__menu__line"></div>
        </div>
    </header>
</template>

<script lang="ts" src="./header.component.ts"></script>
<style scoped lang="sass" src="./header.component.sass"></style>
