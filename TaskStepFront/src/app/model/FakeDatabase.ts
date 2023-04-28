import { Context } from "./context";
import { Project } from "./project";
import { User } from "./user";
import {Item } from "./item";
import { SideBarComponent } from "./sideBarComponent";

export class FakeDatabase {

    public static Items : Item[] = [new Item(0,"test","test",new Context("test"),new Project("test"),new Date(),"test","test"),new Item(0,"test","test",new Context("test"),new Project("test"),new Date(),"test","test"),new Item(0,"test","test",new Context("test"),new Project("test"),new Date(),"test","test")];
    public static Contexts : Context[] = [];
    

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


    /*public static Users : User[] = [
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
*/
    /**
     * Table all of the sidebar componenet of the side
     * They are requested from the server
     */
    private static sideBar : SideBarComponent[] = [ 
        new SideBarComponent("lightbulb", "Idées",0,0), 
        new SideBarComponent("cart", "Vous voulez peut être acheter",0,0), 
        new SideBarComponent("lightning", "Immédiat",0,0),
        new SideBarComponent("newspaper", "Ce week-end",0,0),
        new SideBarComponent("calendar", "Ce mois-ci",0,0),
        new SideBarComponent("world", "Cette année",0,0),
        new SideBarComponent("user", "Peut-être un jour",0,0)
    ];

    public static GetSideBar() : SideBarComponent[] {
        return this.sideBar;
    }

    public static AddItem(item : Item){
        this.Items.push(item);
    }

    public static RemoveItem(id : number){
        this.Items.splice(id - 1)
    }

    public static ModifyItem(index : number,item : Item){
    }

    public static GetAllItems() : Item[] {
        return this.Items;
    }
    
    
}