import { Context } from "./context";


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

    static GetIndexOfContext(context : Context) : number {
        return this.Contexts.indexOf(context);
    }

}