import { Context } from "./context";


export class FakeDatabase {

    public static Contexts : Context[] = [
        new Context("SampleContext"),
        new Context("SampleContext2")
    ];

    static RemoveContext(context : Context){
        const index = this.Contexts.indexOf(context);
        if (index != -1){
            this.Contexts.splice(index)
        }
    }

    static AddContext(context : Context){
        this.Contexts.push(context);
    }

    static ModifyContext(index : number,context : Context){
        this.Contexts[index] = context;
    }

    static GetIndexOfContext(context : Context) : number {
        return this.Contexts.indexOf(context);
    }

}