import { Settings } from "./settings";

export class User{
    /**
     * Id of the user
     */
    public Id : number;
    
    /**
     * Email of the user
     */
    public Email : string;

    /**
     * Password of the user
     */
    public password : string;

    /**
     * Settings of the user
     */
    public Settings : Settings;

    constructor(Id : number, Email : string , password : string, Settings : Settings){
        this.Id = Id;
        this.Email = Email;
        this.password = password
        this.Settings = Settings
    }

}