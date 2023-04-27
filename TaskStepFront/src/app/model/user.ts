import { Settings } from "./settings";

export class User{
    public Id : number;
    public Email : string;
    public password : string;
    public Settings : Settings;

    constructor(Id : number, Email : string , password : string, Settings : Settings){
        this.Id = Id;
        this.Email = Email;
        this.password = password
        this.Settings = Settings
    }

}