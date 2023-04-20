export class Context{
    private title : string;

    constructor(title : string){
        this.title = title;
    }

    get Title() : string {
        return this.title;
    }

    set Title(value : string) {
        this.title = value;
    }
}