export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.role === 'admin';
    }

    isUser(){
        return this.user.role === 'user';
    }

    isAuthor(){
        return this.user.role === 'autor';
    }
    
    isAdminOrAuthor(){
        if(this.user.role === 'admin' || this.user.role === 'autor'){
            return true;
        }
    }


}