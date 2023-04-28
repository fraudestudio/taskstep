export class SideBarComponent{

  /**
   * Image of the component
   */
  private image : string;
  /**
   * Title of the component
   */
  private title : string;
  
  /**
   * Task done of the component
   */
  private done :  number;
  /**
   * Task undone of the component
   */
  private undone : number;
  
  private database : string;
  
  constructor(image : string, title : string, done : number, undone : number, database : string){
    this.image = image;
    this.title = title;
    this.done = done;
    this.undone = undone;
    this.database = database;
  }
  
  get Image() : string {
    return "assets/images/" + this.image + ".png";
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

  get Database() : string {
    return this.database;
  }
}