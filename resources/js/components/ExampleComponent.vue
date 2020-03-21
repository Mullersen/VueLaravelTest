<template>
    <div class="container">
        <p @click="getUsers">click me for users!</p>
        <h3 v-for="user in users[0]" :key="user.id">{{user.name}}</h3>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                users: [], // at the start the users array is empty, until it gets filled when it makes the ajax request. Assuming its gonna send back an object.
            };
        },
        methods: {
             getUsers: function(){ // this is going to ask our back-end to connect to the db and send back the data in JSOn format
                let ajax = new XMLHttpRequest();
                let compData = this; // this changes the scope inside the following function. it makes sure we are referring to the vue oject, not the readystatechange
                ajax.onreadystatechange = function(){
                    if(ajax.status == 200 && ajax.readyState == 4){
                        let jsonData = JSON.parse(JSON.parse(this.responseText));
                        //console.log(this.responseText);
                        compData.users.splice(0, jsonData.length, jsonData); //reference to the vue object and its users array will become/change the data we are getting back from the ajax request to our db.
                        console.log(compData.users);
                    } // the json that is being sent back above in jsonData, is already an array. and we are looping through that above in template.
                };
                ajax.open('GET',"/get-users", true);
                    // we define the endpoint.
                ajax.send();
            }
        }
    }
</script>
