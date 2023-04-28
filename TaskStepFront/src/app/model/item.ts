import { Context } from "./context";
import { Project } from "./project";

export class Item{
    private title : string;

    private notes : string;

    private context : Context;

    private project : Project;  

    private section : string;

    private date : Date;

    private url : string;

    private id : number;

    private done : boolean = false;

    constructor(done: boolean,id : number, title : string, notes : string, context : Context, project : Project, dueDate : Date, url : string, section:  string){

            this.title = title;
            this.notes = notes;
            this.context = context;
            this.section = section;
            this.project = project;
            this.date = dueDate;
            this.url = url;
            this.id = id;
            this.done = done;

    }

    

    get Title() : string {  return this.title;  }

    set Title(value : string) {  this.title = value;  }

    get Id() : number {  return this.id;  }

    set Id(value : number) {  this.id = value;  }

    get Notes() : string { return this.notes; }

    set Notes(value : string) {  this.notes = value;  }

    get Context() : Context {  return this.context;  }

    set Context(value : Context) {  this.context = value;  }

    get Project() : Project {  return this.project;  }

    set Project(value : Project) {  this.project = value;  }

    get Date() : Date { return this.date;  }

    set Date(value : Date) {  this.date = value;  }

    get Url() : string {
        if (this.url){
            return this.url;  
        }  
        else {
            return ""
        }
    }

    set Url(value : string) {  this.url = value;  }

    get Section() : string {  return this.section;  }

    set Section(value : string) {  this.section = value;  }

    get Done() : boolean {  return this.done;  }

    set Done(value : boolean) {  this.done = value;  }

}