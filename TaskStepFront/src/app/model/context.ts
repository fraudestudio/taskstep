export class Context{
    private title : string;

    private id : number  = -1;

    constructor(title : string, id : number){
        this.title = title;
        this.id = id;
    }

    get Title() : string {
        return this.title;
    }

    set Title(value : string) {
        this.title = value;
    }

    
    get Id() : number {
        return this.id;
    }

    set Id(value : number) {
        this.id = value;
    }
}