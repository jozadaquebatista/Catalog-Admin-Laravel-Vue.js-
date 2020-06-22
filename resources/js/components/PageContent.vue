<template>
    <div id="page-content">

        <Searchbox />
        <ProductTable/>
        
        <!-- <ProductForm/> -->
    </div>
</template>

<style scoped>
    #page-content {
        background: #fff;
        width: 100%;
        height: 100vh;

        /* alinhamento input */
        text-align: center;
    }

    .prd-row {
        width: 250px;
        height: 20px;
        background: #f00;
    }
</style>
