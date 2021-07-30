<template>
    <div class="add-item">
        <div v-if="formVisible">
            <input type="text" v-model="item.title" placeholder="Nhập tên" />
            <input type="text" v-model="item.due_date" placeholder="Nhập deadline"/>
        </div>
        <button @click="addItem()">Thêm</button>
        <!-- <font-awesome-icon icon="user-secret" 
        @click="addItem()"
        :class="[item.title && item.due_date ? 'active' : 'inactive', 'plus']"
        /> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            item: {
                title: "",
                due_date: ""
            },
            formVisible: false
        }
    },
    methods: {
        addItem() {
            // this.formVisible = true;
            if(!this.formVisible)
            {
                this.formVisible = true;
                return ;
            }
            if(this.item.title == '') {
                return ;
            }
            if(this.item.due_date == '') {
                return ;
            }

            axios.post('api/item/store', {
                title: this.item.title,
                due_date: this.item.due_date
            }, {
                  headers: {
                    'Authorization': `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYyNzUzMTY2OCwiZXhwIjoxNjI3NjE4MDY4LCJuYmYiOjE2Mjc1MzE2NjgsImp0aSI6IjBraTJqZFhNT3dOQzh5RUwiLCJzdWIiOjU5NSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.mzdwYRz_xhbIOf4GVI0705UTzUiO49ztQDPR0F_NZgU` 
                }
            }).then(response => {
                if(response.status == 200)
                {
                    this.item.title = "";
                    this.item.due_date = "";
                    this.formVisible = false;
                    this.$emit('reloadList');
                    this.$message({
                        message: 'Thêm thành công',
                        type: 'success'
                    });
                }
            })
            .catch(err => {
                console.log(err);
            });
        }
    }
}
</script>

<style scoped>
.add-item 
{
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #ae5f75;
    padding: 20px;
}

input 
{
    width: 90%;
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin: 5px 0px;
    /* margin-right: 10px; */
}

.plus {
    font-size: 20px;
}

.active {
    color: #00CE25;
}

.inactive {
    color: #999999;
}

button 
{
    background-color: #6d335c;
    outline: none;
    border:none;
    width: 120px;
    border-radius: 4px;
    padding: 10px;
    color: #fff;
}
</style>