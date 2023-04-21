import { Context } from "./context";
import { Project } from "./project";

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


}