export class User{
    public name : string;
    public mail : string; 
    public password : string;

    constructor(name : string, mail : string, password : string){
        this.name = name;
        this.mail = mail;
        this.password = password;
    }
}