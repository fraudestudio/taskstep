import { Context } from "./context";


export class FakeDatabase {

    public static Contexts : Context[] = [
    ];

    constructor(){
    }

    static RemoveContext(context : Context){
        const index = this.Contexts.indexOf(context);
        if (index != -1){
            this.Contexts.splice(index)
        }
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