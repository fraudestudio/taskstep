import { Context } from "./context";
import { Project } from "./project";

export class Item{
    private title : string;

    private note : string;

    // private section : string;
    
    private context : Context;

    private project : Project;  

    private dueDate : Date;

    private url : string;

    private id : number = 0;

    constructor(title : string, note : string, context : Context, project : Project, dueDate : Date, url : string){
        
        this.title = title;
        this.note = note;
        this.context = context;
        this.project = project;
        this.dueDate = dueDate;
        this.url = url;

    }

    get Title() : string {  return this.title;  }

    set Title(value : string) {  this.title = value;  }

    get Id() : number {  return this.id;  }

    set Id(value : number) {  this.id = value;  }

    get Note() : string {  return this.note;  }

    set Note(value : string) {  this.note = value;  }

    get Context() : Context {  return this.context;  }

    set Context(value : Context) {  this.context = value;  }

    get Project() : Project {  return this.project;  }

    set Project(value : Project) {  this.project = value;  }

    get DueDate() : Date {  return this.dueDate;  }

    set DueDate(value : Date) {  this.dueDate = value;  }

    get Url() : string {  return this.url;  }

    set Url(value : string) {  this.url = value;  }

}