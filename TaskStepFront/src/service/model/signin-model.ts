import { User } from "src/app/model/user";

export class SignInModel{
    public Token : string;
    public User : User;

    constructor(Token : string, User : User){
        this.Token = Token;
        this.User = User;
    }
}