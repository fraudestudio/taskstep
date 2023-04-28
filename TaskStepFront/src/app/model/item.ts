import { Context } from "./context";
import { Project } from "./project";

export class Item{
    private title : string;

    private note : string;

    private context : Context;

    private project : Project;  

    private section : string;

    private dueDate : Date;

    private url : string;

    private id : number;

    private done : boolean = false;

    constructor(done: boolean,id : number, title : string, note : string, context : Context, project : Project, dueDate : Date, url : string, section:  string){

            this.title = title;
            this.note = note;
            this.context = context;
            this.section = section;
            this.project = project;
            this.dueDate = dueDate;
            this.url = url;
            this.id = id;
            this.done = done;

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

    get Section() : string {  return this.section;  }

    set Section(value : string) {  this.section = value;  }

    get Done() : boolean {  return this.done;  }

    set Done(value : boolean) {  this.done = value;  }

}