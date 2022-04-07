<template>
    <div id="main-wrapper">
        <NavbarHeader />
        <Aside />
        <Content />
        <Footer />
    </div>
</template>

<script>
import NavbarHeader from "./layout/Nav";
import Aside from "./layout/Aside";
import Footer from "./layout/Footer";
import Content from "./layout/Content";

export default {
    components: {
        NavbarHeader,
        Aside,
        Footer,
        Content,
    },
};
</script>
