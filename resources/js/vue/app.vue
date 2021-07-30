<template>
    <div class="container">
        <h1 id="title">To-Do List</h1>
        <div>
            <!-- <div class="search-box">
                <input type="text" placeholder="Tìm kiếm" v-model="query.title"/>
                <i class="el-icon-search" @click="getList()"></i>
            </div> -->

            <addItemForm v-on:reloadList="getList()"></addItemForm>
        </div>
        <list-view :items="items" v-on:reloadList="getList()"></list-view>
    </div>
</template>

<script>
import addItemForm from "./addItemForm"
import listView from "./listView";
export default {
    components: {
        addItemForm,
        listView
    },    
    data() {
        return {
            items: [],
            query: {
                page: 1,
                limit: 10,
                title: ''
            }
        }
    },
    methods: {
        getList() {
            axios.get('/api/items', {
                params: this.query,
                headers: {
                    'Authorization': `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYyNzUzMTY2OCwiZXhwIjoxNjI3NjE4MDY4LCJuYmYiOjE2Mjc1MzE2NjgsImp0aSI6IjBraTJqZFhNT3dOQzh5RUwiLCJzdWIiOjU5NSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.mzdwYRz_xhbIOf4GVI0705UTzUiO49ztQDPR0F_NZgU` 
                }                
            })
            .then(response => {
                this.items = response.data.data;
            }).catch(err => {
                console.log(err);
            })
        }
    },
    created() {
        this.getList();
    }
}
</script>

<style>
#app 
{
    background-color: #4d244e;
    min-height: 100vh;
}

body 
{
    margin: 0;
    padding: 0;
}
</style>

<style scoped>
.container 
{
    width: 350px;
    margin: auto;
}


#title 
{
    text-align: center;
    margin: 0;
    color: #AA0000;
    font-size: 2rem;
}

.search-box 
{
    position: relative;
    display: flex;
    justify-content: flex-end;
    margin-right: 12%;
}

.search-box input
{
    width: 30%;
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin: 5px 0px;
}

.el-icon-search 
{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}
</style>