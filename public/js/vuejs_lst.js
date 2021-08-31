const app = new Vue({
    el:"#app",
    data:{
        inputvalue: "",
        articles: []
    },
    methods:{
        add(){
            axios.post("http://localhost/k/listcourse-main/public/api",{"name":this.inputvalue})
            .then(res =>{
                this.articles.push(res.data);
            })
        },
        remove(index){
            let id = this.articles[index].id;
            axios.delete("http://localhost/k/listcourse-main/public/api/"+id)
            .then(res =>{
                this.articles.splice(index,1);
            })
        },
        update(index){
            let id = this.articles[index].id;
            axios.put("http://localhost/k/listcourse-main/public/api/"+id)
            .then(res =>{
                this.articles[index].buy = res.data.buy;
            })
        }
    },
    mounted(){
        var url = "http://localhost/k/listcourse-main/public/api";
        fetch(url).then(res => res.json())
        .then(data =>{
            this.articles = data
        })
    },
});