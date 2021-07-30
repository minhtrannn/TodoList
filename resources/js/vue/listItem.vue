<template>
    <div class="item">
        <input type="checkbox" @change="updateCheck()" v-model="item.status" />
        <span :class="[item.status ? 'completed' : '', 'item-text']">{{item.title}}</span>
        <button @click="removeItem()" class="delete-item">
            <font-awesome-icon icon='trash'/>
        </button>
    </div>
</template>

<script>

export default {
    props: ['item'],
    methods: {
        updateCheck() {
            axios.put('api/item/' + this.item.id, {
                title: this.item.title,
                due_date: this.item.due_date,
                status: this.item.status
            }, {
                  headers: {
                    'Authorization': `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYyNzUzMTY2OCwiZXhwIjoxNjI3NjE4MDY4LCJuYmYiOjE2Mjc1MzE2NjgsImp0aSI6IjBraTJqZFhNT3dOQzh5RUwiLCJzdWIiOjU5NSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.mzdwYRz_xhbIOf4GVI0705UTzUiO49ztQDPR0F_NZgU` 
                }                
            }).then(response => {
                if(response.status == 200)
                {
                    this.$emit('reloadList');
                }
            }).catch(err => {
                console.log(err);
            })
        },
        removeItem() {
            axios.delete('api/item/' + this.item.id, {
                headers: {
                    'Authorization': `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYyNzUzMTY2OCwiZXhwIjoxNjI3NjE4MDY4LCJuYmYiOjE2Mjc1MzE2NjgsImp0aSI6IjBraTJqZFhNT3dOQzh5RUwiLCJzdWIiOjU5NSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.mzdwYRz_xhbIOf4GVI0705UTzUiO49ztQDPR0F_NZgU` 
                }                     
            })
            .then(response => {
                if(response.status == 200){
                    this.$emit('reloadList');
                }
            }).catch(err => {
                console.log(err);
            })
        }
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}

.item-text 
{
  /* background: #6d335c; */
  /* border-bottom: 1px solid #34495E; */
  color: #6d335c;
  font-size: 1.2rem;
}

/* .item-text:before 
{
  content:"";
  width: 20px;
  height: 20px;
  background: #fff;
  display: block;
  position: absolute;
  border-radius: 100%;
  left: 10px;
  top: 30%;
  transition: border 0.7s ease
} */

input 
{
    /* display: none; */
}


.delete-item 
{
    background: transparent;
    border: none;
    color: #6d335c;
    outline: none;
    position: absolute;
    right: 10px;
}

/* .item 
{
    display: flex;
    align-items: center;
    justify-content: center;
} */

.item 
{
    background: #ae5f75;
    height: 69px;
    width: 100%;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #2C3E50;
    color: #fff;
    text-transform: capitalize;
    font-weight: 900;
    font-size: 11px;
    letter-spacing: 1px;
    text-indent: 20px;
    cursor: pointer;
    transition: all 0.7s ease;
    position: relative;
    padding: 20px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
}

</style>