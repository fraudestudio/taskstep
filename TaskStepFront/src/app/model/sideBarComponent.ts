export class SideBarComponent{

    private image : string;
    private title : string;
  
    private done :  number;
    private undone : number;
  
  
  
    constructor(image : string, title : string, done : number, undone : number){
      this.image = image;
      this.title = title;
      this.done = done;
      this.undone = undone;
    }
  
    get Image() : string {
      return "assets/" + this.image + ".png";
    }
  
    get Title() : string {
      return " " + this.title;
    }
  
    get Done() : string {
      return "(" + this.done + ")";
    }
  
    get UnDone() : string {
      return "(" + this.undone + ")";
    }
  }