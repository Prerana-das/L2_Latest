<template>
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-8">
                 <Input v-model="form.name" placeholder="Enter Tag..."/>
            </div>
            <div class="col-md-4">
                <Button type="success" @click="add_tag">Add</Button>
            </div>
        </div>
        <h1 class="text-center">All Category</h1>
        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in tag" :key="index">
                    <td>{{item.id}} </td>
                    <td>
                        <template  v-if="isEdit && index == editIndex">  <Input v-model="edit_form.name" placeholder="Enter Category..."/></template>
                        <template v-else ><h5> {{item.name}} </h5></template>
                       
                    </td>
                    <td>
                        <template   v-if="isEdit && index == editIndex">
                            <button class="btn btn-success" @click="edit_tag" >Save</button>
                            <button class="btn btn-warning" @click="isEdit = false">Cancel</button>
                        </template>
                        <template v-else>
                            <button class="btn btn-primary" @click="isEditOn(item,index)" >Edit</button>
                            <button class="btn btn-danger" @click="delete_tag(item.id,index)" >Delete</button>
                        </template>
                            
                    </td>
                </tr>
            </tbody>
            </table>
    </div>
</template>

<script>
export default {
    data(){
        return{
            tag:[],
            form:{
                name:'',
            },
            edit_form:{
                name:'',
                id:'',
            },
            isEdit:false,
            editIndex:-1,
        }
    },
    methods:{
        async all_tag(){
            const res = await this.callApi('get','all_tag')
            if(res.status == 200){
                this.tag = res.data
            }
        },
        async add_tag(){
            if(this.form.name == '') return this.i("Category Name is empty!");
            const res = await this.callApi('post','add_tag',this.form)
            if(res.status == 201){
                this.tag.push(res.data)
                this.s("New Category Added !")
                this.form.name = ''
            }
            else{
                this.swr();
            }
        },
        async edit_tag(){
            if(this.edit_form.name == '') return this.i("Category Name is empty!");
            const res = await this.callApi('post','edit_tag',this.edit_form)
            if(res.status == 200){
                this.tag[this.editIndex] = _.clone(this.edit_form) 
                this.s("Category Updated  !")
                let ob ={
                    name:'',
                    id:'',
                }
                this.edit_form = ob 
                this.editIndex = -1
                this.isEdit = false
            }
            else{
                this.swr();
            }
        },
        async delete_tag(id,index){
            if(!confirm("Are you sure to delete this Category")){
                return;
            }
            let ob = {
                id:id
            }
            const res = await this.callApi('post','delete_tag',ob)
            if(res.status == 200){
                this.i(' Category have been successfully Deleted!')
                this.tag.splice(index,1)
            }
        },
        isEditOn(item,index){
            this.edit_form = _.clone(item) 
            this.editIndex = index
            this.isEdit = true
        }
    },
    created(){
        this.all_tag();
    }
}
</script>