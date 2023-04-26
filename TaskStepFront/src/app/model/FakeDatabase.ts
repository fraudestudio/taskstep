import { Context } from "./context";
import { Project } from "./project";
import { User } from "./user";

export class FakeDatabase {

    public static Contexts : Context[] = [
    ];

    constructor(){
    }

    static RemoveContext(id : number){
        this.Contexts.splice(id - 1)
    }

    static AddContext(context : Context){
        this.Contexts.push(context);
        context.Id = this.Contexts.length;
    }

    static ModifyContext(index : number,context : Context){
        this.Contexts[index - 1] = context;
        context.Id = index;
    }

    /// Projects

    public static Projects : Project[] = [
    ];

    static RemoveProject(id : number){
        this.Projects.splice(id - 1)
    }

    static AddProject(project : Project){
        this.Projects.push(project);
        project.Id = this.Projects.length;
    }

    static ModifyProject(index : number,project : Project){
        this.Projects[index - 1] = project;
        project.Id = index;
    }


    public static Users : User[] = [
        new User("test@gmail.com","test"),
    ];

    public static AddUser(mail : string, password : string) {
        FakeDatabase.Users.push(new User(mail,password));
    }

    public static VerifyUser(mail : string, password : string) : boolean{
        var res  = false;
        FakeDatabase.Users.forEach(user => {
            if (user.mail == mail){
                if (user.password == password){
                    res = true;
                }
            }
        });
        return res;
    }

    public static ChangePassword(mail : string, password : string){
        FakeDatabase.Users.forEach(user => {
            if (user.mail == mail){
                user.password = password;
            }
        });      
    }

    public static GetPassword(mail :string) : string {
        var res = ""
        FakeDatabase.Users.forEach(user => {
            if (user.mail == mail){
                res = user.password;
            }
        });    
        
        return res;
    }


}